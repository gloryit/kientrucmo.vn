<?php
/**
 * Created by PhpStorm.
 * User: minhphuc
 * Date: 10/01/2018
 * Time: 10:56
 */

define('ASSET_DEV', true); // echo $this->Html->script('/assets/js'.(ASSET_DEV?'-dev':'').'/p_homepage.js?v='.ASSETS_VERSION )
define('APP_TIMEZONE', 'Asia/Ho_Chi_Minh');
define('ASSETS_VERSION', 1);
define('DEFAULT_LANG', 'VI');
define('PAH_DEBUG', false);

/**
 * File locate vi en path
 */
define('LOCALE_VI', APP . 'Locale' . DS . 'vi' . DS . 'default.po');
define('LOCALE_EN', APP . 'Locale' . DS . 'en' . DS . 'default.po');

/**
 * Config database
 */
define('DATABASE_DEFAULT', [
    'host' => 'localhost',
    'port' => 3306,
    'username' => 'root',
    'password' => 'tmphucgl',
    'database' => 'kientrucmo'
]);

/**
 * Config EmailTransport
 */
define('EmailTransport', [
    'host' => 'ssl://smtp.gmail.com',
    'port' => 465,
    'timeout' => 30,
    'username' => 'nguyenchau.hoanganh@gmail.com',
    'password' => 'wjxbkslyuyzqmsrn',
]);

/**
 * Config Email
 */
define('Email', [
    'from' => 'nguyenchau.hoanganh@gmail.com',
]);
