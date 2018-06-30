<?php
/**
 * Created by PhpStorm.
 * User: gloryit
 * Date: 30/06/2018
 * Time: 20:05
 */

if (!function_exists('mb_ucwords'))
{
    function mb_ucwords($str)
    {
        return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
    }
}
