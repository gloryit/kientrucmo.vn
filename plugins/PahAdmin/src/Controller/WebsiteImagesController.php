<?php

namespace PahAdmin\Controller;

use App\Controller\API\StringAPI;
use App\Model\Entity\WebsiteImage;
use Cake\Filesystem\File;
use Cake\Http\Response;
use Cake\I18n\Time;
use Cake\Validation\Validation;
use Cake\Validation\Validator;
use Intervention\Image\ImageManagerStatic;

/**
 * Class WebsiteImagesController
 * @property \App\Model\Table\WebsiteImagesTable $WebsiteImages
 * @property \PahAdmin\Controller\Component\WebsiteImageComponent $WebsiteImage
 * @package PahAdmin\Controller
 */
class WebsiteImagesController extends AdminController {

    /**
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('PahAdmin.WebsiteImages');
    }

    /**
     * @return mixed
     */
    public function list() {
        $response = $this->response->withHeader('Content-Type', 'application/json');

        $page = abs((int) $this->request->getData('page'));
        $keyword = $this->request->getData('keyword');
        $limit = 15;
        $day = abs((int) $this->request->getData('day'));
        $month = abs((int) $this->request->getData('month'));
        $year = abs((int) $this->request->getData('year'));

        if(!Validation::range($day, 1, 31)) {
            $day = 0;
        }

        if(!Validation::range($month, 1, 12)) {
            $month = 0;
        }

        if(!Validation::range($year, 1970, 2300)) {
            $year = 0;
        }

        if(strlen($keyword) > 255) {
            $keyword = '';
        }

        $image_query = $this->WebsiteImages->find();

        if($keyword) {
            $image_query->where([
               'OR' => [
                   'name LIKE' => '%' . $keyword . '%',
                   'description LIKE' => '%' . $keyword . '%',
               ]
            ]);
        }
        if($year) {
            $image_query->where([
                'year(created)' => $year
            ]);

            if($month) {
                $image_query->where([
                    'month(created)' => $month
                ]);

                if($day) {
                    $image_query->where([
                        'day(created)' => $day
                    ]);
                }
            } else {
                $day = 0;
            }

        } else {
            $day = 0;
            $month = 0;
        }

        $total = $image_query->count();

        if(ceil($total / $limit) < $page || $page < 1) {
            $page = 1;
        }

        $image_query->select([
                'id',
                'name',
                'uri',
                'width',
                'height',
                'created',
            ])
            ->orderDesc('created')
            ->limit($limit)
            ->page($page);

        $result = $image_query->toArray();

        $response = $response->withStringBody(json_encode([
            'status' => 200,
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
            'day' => $day,
            'month' => $month,
            'year' => $year,
        ]));

        return $response;
    }

    /**
     * Upload images
     * @return mixed
     * @throws \Exception Exception.
     */
    public function doUpload()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->response = $this->response->withHeader('Content-Type', 'application/json');

            $file_validator = new Validator();

            $file_validator->requirePresence('image');
            $file_validator->notEmpty('image');
            $file_validator->add('image', [
                'mineType' => [
                    'rule' => [
                        'mimeType', ['image/jpeg', 'image/png', 'image/gif']
                    ],
                ],
                'fileSize' => [
                    'rule' => [
                        'fileSize', '<=', '10MB'
                    ]
                ],
                'extension' => [
                    'rule' => [
                        'extension', ['gif', 'jpeg', 'png', 'jpg']
                    ]
                ]
            ]);

            $errors = $file_validator->errors($this->request->getData());


            if ( !$errors ) {
                $file_extension_map = [
                    'gif' => 'gif',
                    'jpeg' => 'jpg',
                    'jpg' => 'jpg',
                    'png' => 'png',
                ];

                $uploaded_file = $this->request->getUploadedFile('image');
                $tmp_image = ImageManagerStatic::make($uploaded_file->getStream()->getContents());
                $path_info = pathinfo($uploaded_file->getClientFilename());

                if (!$path_info['filename']) {
                    throw new \Exception('Invalid file name!');
                }

                $website_image = new WebsiteImage();
                $website_image->mine_type = $uploaded_file->getClientMediaType();
                $website_image->name = StringAPI::filterSearchKeyword(mb_strtolower($path_info['filename']));
                $website_image->picture = file_get_contents($uploaded_file->getStream()->getMetadata('uri'));
                $website_image->ext = mb_strtolower($path_info['extension']);
                $website_image->created = new Time(); // For file name
                $website_image->width = $tmp_image->getWidth();
                $website_image->height = $tmp_image->getHeight();

                /** @var \App\Model\Entity\WebsiteImage $last_duplicate_image */
                $last_duplicate_image = $this->WebsiteImages->find()
                    ->select([
                        'id',
                        'name'
                    ])
                    ->where([
                        'name REGEXP' => '^' . $website_image->name . '(-[0-9]+)?$'
                    ])
                    ->orderDesc('name')
                    ->first();

                // Check duplicate file name in db
                if ($last_duplicate_image) {
                    if ($website_image->name == $last_duplicate_image->name) {
                        $website_image->name = $website_image->name . '-1';
                    } else {
                        $name_explored = explode('-', $last_duplicate_image->name);
                        $affix = (int)end($name_explored);
                        $website_image->name .= '-' . (++$affix);
                    }
                }

                $website_image->uri = $this->getImageUri($website_image->created, $website_image->name . '.' . $file_extension_map[strtolower($path_info['extension'])]);

                if ($this->WebsiteImages->save($website_image)) {
                    $this->loadComponent('PahAdmin.WebsiteImage');
                    $this->WebsiteImage->renderWebsiteImage($website_image);
                }
                return $this->response->withStringBody(json_encode([
                    'status' => 200
                ]));
            }
        }
    }

    /**
     * Remove image in file system and in database
     *
     * @param int $image_id Image ID.
     * @return Response
     * @throws \Exception Exception.
     */
    public function remove($image_id) {
        if ($this->request->is(['patch', 'post', 'put'])) {
            throw new \Exception('Invalid request, must be PUT or POST');
        }

        $image_id = (int) $image_id;

        if(!$image_id) {
            throw new \Exception('Invalid image ID to remove');
        }

        /** @var \App\Model\Entity\WebsiteImage $image */
        $image = $this->WebsiteImages->find()
            ->select([
                'id',
                'name',
                'uri',
                'width',
                'height',
                'created',
            ])
            ->where([
                'id' => $image_id
            ])
            ->firstOrFail();

        $this->loadComponent('PahAdmin.WebsiteImage');
        $this->WebsiteImage->removeWebsiteImage($image);
        $this->WebsiteImages->delete($image);

        return $this->response->withHeader('Content-Type', 'application/json')
            ->withStringBody(json_encode([
                'status' => 200
            ]));
    }

    /**
     * @param \Cake\I18n\Time $time Time.
     * @param string $file_name File name.
     * @return string
     */
    protected function getImageUri($time, $file_name) {
        return WEBSITE_IMAGE_PUBLIC_PATH . $time->setTimezone(APP_TIMEZONE)->format('Y/m/') . $file_name;
    }
}
