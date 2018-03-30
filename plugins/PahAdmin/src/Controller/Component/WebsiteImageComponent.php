<?php

namespace PahAdmin\Controller\Component;

use Cake\Controller\Component;

/**
 * Class WebsiteImageComponent
 * @package PahAdmin\Controller\Component
 */
class WebsiteImageComponent extends Component {

    /**
     * @param \App\Model\Entity\WebsiteImage $website_image Website image.
     * @return string
     */
    public function renderWebsiteImage($website_image) {
        $uri = $website_image->uri;
        $matches = $this->checkValidImagePath($uri);

        if ($matches) {
            $path_info = pathinfo($uri);
            $this->makeDirIfNotExisted($path_info['dirname']);
            $file_full_path = WWW_ROOT . substr($uri, 1);

            file_put_contents($file_full_path, $website_image->picture);
            return $file_full_path;
        }
        return false;
    }

    /**
     * @param \App\Model\Entity\WebsiteImage $website_image Website image.
     * @return void
     */
    public function removeWebsiteImage($website_image) {
        if($this->checkValidImagePath($website_image->uri)) {
            $file_full_path = WWW_ROOT . substr($website_image->uri, 1);
            if(is_file($file_full_path)) {
                try {
                    unlink($file_full_path);
                } catch (\Exception $e) {

                }
            }
        }
    }

    /**
     * @param string $uri Uri.
     * @return mixed
     */
    protected function checkValidImagePath($uri) {
        $regEx = '/^(' . str_replace('/', '\/', WEBSITE_IMAGE_PUBLIC_PATH) . '[0-9]{4}\/[0-9]{2}\/[^\/]+)/';
        preg_match($regEx, $uri, $matches, PREG_OFFSET_CAPTURE);

        return $matches;
    }

    /**
     * @param string $path Path.
     * @param string $root_path Root path.
     * @return void
     */
    protected function makeDirIfNotExisted($path, $root_path = WWW_ROOT) {
        $path_tmp = substr($path, 1);

        if(!file_exists($root_path . $path_tmp)) {
            $path_arr = explode('/', $path_tmp);

            $current_path = substr($root_path, 0, strlen($root_path) - 1);
            $count = 0;
            foreach ($path_arr as $folder) {
                if($count++ > 6) {
                    break;
                }

                $current_path .= DS . $folder;
                if(!file_exists($current_path)) {
                    mkdir($current_path);
                }
            }
        }
    }
}
