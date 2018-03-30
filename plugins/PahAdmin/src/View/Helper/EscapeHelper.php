<?php

namespace PahAdmin\View\Helper;

use Cake\View\Helper;
use HTMLPurifier_Config;

class EscapeHelper extends Helper{

    /**
     * Escape output html text using HTMLPurifier library
     * @param string $text Text.
     * @return mixed
     */
    public function purify($text)
    {
        require_once ROOT . DS . 'vendor' . DS . 'ezyang' . DS . 'htmlpurifier' . DS . 'library' . DS . 'HTMLPurifier.auto.php';

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);

        return $purifier->purify($text);
    }

}
