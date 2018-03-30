<?php

namespace App\Error;

use Cake\Controller\Exception\MissingActionException;
use Cake\Error\ErrorHandler;
use Cake\Error\PHP7ErrorException;
use Cake\Log\Log;
use Cake\Routing\Exception\MissingControllerException;
use Cake\Routing\Exception\MissingRouteException;
use Exception;

/**
 * Class AppErrorHandler
 * @package App\Error
 */
class AppErrorHandler extends ErrorHandler
{

    /**
     * Handles exception logging
     *
     * @param \Exception $exception Exception instance.
     * @return bool
     */
    protected function _logException(Exception $exception)
    {
        $config = $this->_options;
        $unwrapped = $exception instanceof PHP7ErrorException ?
            $exception->getError() :
            $exception;

        if (empty($config['log'])) {
            return false;
        }

        if (!empty($config['skipLog'])) {
            foreach ((array)$config['skipLog'] as $class) {
                if ($unwrapped instanceof $class) {
                    return false;
                }
            }
        }

        if ($exception instanceof MissingControllerException || $exception instanceof MissingRouteException || $exception instanceof MissingActionException) {
            return Log::write('error', $this->_getMessage($exception));
        } else {
            return Log::error($this->_getMessage($exception));
        }
    }
}
