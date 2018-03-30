<?php

namespace PahAdmin\View;

use Cake\View\View;

/**
 * Class AdminView
 * @package PahAdmin\View
 * @property \PahAdmin\View\Helper\EscapeHelper $Escape
 */
class AdminView extends View {

    /**
     * @return void
     */
    public function initialize() {
        parent::initialize();
    }

    public function appendScriptsBottom() {
        $this->append('scripts_bottom');
    }

    public function appendStylesTop() {
        $this->append('styles_top');
    }

    /**
     * @param [] $array
     * @param string $glue
     * @return string
     */
    public function concat($array, $glue = '-') {
        $arr = array_filter($array);

        return $arr?implode($glue, $arr):'';
    }
}
