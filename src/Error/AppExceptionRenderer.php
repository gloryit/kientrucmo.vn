<?php

namespace App\Error;

use App\Controller\AppErrorController;
use Cake\Controller\ErrorController;
use Cake\Core\Configure;
use Cake\Error\ExceptionRenderer;
use Cake\Http\ServerRequest;
use Cake\Mailer\Exception\MissingActionException;
use Cake\Network\Exception\InvalidCsrfTokenException;
use Cake\Routing\Exception\MissingControllerException;
use Cake\Routing\Exception\MissingRouteException;
use Exception;

/**
 * Class AppExceptionRenderer
 * @package App\Error
 *
 * @property \App\Controller\AppController $controller
 */
class AppExceptionRenderer extends ExceptionRenderer
{
//    protected
//        $_websiteImageRegEx,
//        $_request;

    /**
     * AppExceptionRenderer constructor.
     * @param Exception $exception Exception.
     */
//    public function __construct(Exception $exception)
//    {
//        $this->_request = new ServerRequest();
//        $this->_websiteImageRegEx = '/^(' . str_replace('/', '\/', WEBSITE_IMAGE_PUBLIC_PATH) . ')/';
//
//        parent::__construct($exception);
//    }

    /**
     * @return AppErrorController|\Cake\Controller\Controller|ErrorController
     */
//    protected function _getController()
//    {
//        if (Configure::read('debug')) {
//            if ($this->error instanceof MissingControllerException || $this->error instanceof MissingActionException || $this->error instanceof MissingRouteException) {
//                if ($this->isRequestWebsiteImage()) {
//                    return new AppErrorController();
//                }
//            }
//
//            return new ErrorController();
//        } else {
//            return new AppErrorController();
//        }
//    }

    /**
     * @return \Cake\Http\Response
     */
//    public function render()
//    {
//        $exception = $this->error;
//        $code = $this->_code($exception);
//
//        if ($exception instanceof MissingControllerException | $exception instanceof MissingActionException | $exception instanceof MissingRouteException) {
//            $this->checkWebsiteImageRendering();
//        }
//
//        if ($exception instanceof InvalidCsrfTokenException) {
//            $this->controller->set(compact('exception'));
//        }
//        $this->controller->set(compact('code'));
//
//        if (Configure::read('debug')) {
//            return parent::render();
//        } else {
//            return $this->controller->render('error400');
//        }
//    }

    /**
     * @return bool|string
     */
//    protected function isRequestWebsiteImage()
//    {
//        if (preg_match($this->_websiteImageRegEx, $this->_request->getUri()->getPath(), $matches, PREG_OFFSET_CAPTURE)) {
//            return $this->_request->getUri()->getPath();
//        }
//
//        return false;
//    }

    /**
     * @return void
     */
//    protected function checkWebsiteImageRendering()
//    {
//        if ($image_uri = $this->isRequestWebsiteImage()) {
//            try {
//                $this->controller->loadComponent('PahAdmin.WebsiteImage');
//                $this->controller->loadModel('WebsiteImages');
//
//                /** @var \App\Model\Entity\WebsiteImage $website_image */
//                $website_image = $this->controller->WebsiteImages->find()
//                    ->where([
//                        'uri' => $image_uri
//                    ])
//                    ->first();
//
//                if ($website_image && $picture_path = $this->controller->WebsiteImage->renderWebsiteImage($website_image)) {
//                    if (file_exists($picture_path)) {
//                        $this->sendImage($picture_path);
//                    }
//                }
//            } catch (\Exception $e) {
//
//            }
//        }
//    }

    /**
     * @param string $picture_path Picture path.
     * @return void
     */
//    protected function sendImage($picture_path)
//    {
//        /** Redirect if invalid jpg or png */
//        $request_uri = $this->controller->request->getUri()->getPath();
//        $real_extension = substr($picture_path, -3);
//        $requested_extension = strtolower(substr($request_uri, -3));
//
//        if ($real_extension != $requested_extension) {
//            header("Location: " . substr($request_uri, 0, strlen($request_uri) - 4) . '.' . $real_extension, true, 301);
//            exit;
//        }
//
//        header('Content-Description: File Transfer');
//        header('Content-Type: application/octet-stream');
//        header('Content-Disposition: attachment; filename="' . basename($picture_path) . '"');
//        header('Expires: 0');
//        header('Cache-Control: must-revalidate');
//        header('Pragma: public');
//        // header('Content-Length: ' . filesize($avatarPath));
//        readfile($picture_path);
//        exit;
//    }
}
