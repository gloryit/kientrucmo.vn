<?php
/**
 * Created by PhpStorm.
 * User: minhphuc
 * Date: 10/01/2018
 * Time: 08:30
 */

namespace App\Controller\API;


class StringAPI {
    /**
     * @param string $string String.
     * @return mixed|string
     */
    public static function filterUrlRemoveBracket($string) {
        if(strpos($string, '(')) {
            $string = substr($string, 0, strpos($string, '('));
        }

        return self::convertToAscii($string);
    }

    /**
     * @param string $str String.
     * @return mixed|string
     */
    public static function convertToAscii($str) {
        $str = trim($str);

        /** remove Vietnamese signals */
        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ', 'd' => 'đ', 'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ', 'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ', 'D' => 'Đ', 'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ', 'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ', 'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự', 'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        ];

        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

        /** convert special character to whitespaces */
        $str = preg_replace('/[^a-zA-Z0-9]/', ' ', $str);

        /** remove double space and new line characters */
        $str = preg_replace("/\s+/", " ", trim($str));

        /** convert space into hyphen */
        $str = preg_replace("/[\/_|+ -]+/", '-', $str);

        return $str;
    }

    /**
     * @param string $keyword Keyword.
     * @return mixed|string
     */
    public static function filterSearchKeyword($keyword) {
        $str = trim($keyword);
        /** convert special character to whitespaces */
        $str = preg_replace('/[!@#%^`~,.&*()=+\[\];:\'"<>?\\/{}<>]/', ' ', $str);

        /** remove double space and new line characters */
        $str = preg_replace("/\s+/", " ", trim($str));

        /** convert space into hyphen */
        $str = preg_replace("/[\/_|+ -]+/", '-', $str);

        return $str;
    }

    /**
     * @param string $string String.
     * @return mixed|string
     */
    public static function filterSpace($string) {
        $str = trim($string);
        /** remove double space and new line characters */
        $str = preg_replace("/\s+/", " ", trim($str));

        $str = explode(' ', $str);

        return $str;
    }

    /**
     * @param string $word Word.
     * @return int
     */
    public static function isJapanese($word) {
        return preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $word);
    }

    /**
     * @param string $string String.
     * @param string $pattern String.
     * @return string
     */
    public static function addSpaceBetween($string, $pattern = '/') {
        $arr = explode($pattern, $string);

        foreach ($arr as &$item) {
            $item = trim($item);
        }

        return implode(' ' . $pattern . ' ', $arr);
    }

    /**
     * @param string $filename Filename.
     * @param string $ext Extension.
     * @return string
     */
    public static function sanitizeFileName($filename, $ext = '') {
        $filename = trim(preg_replace("(<|>|/)", " ", $filename));
        $filename = empty($ext) ? $filename : $filename . '.' . $ext;

        return $filename;
    }

    /**
     * @param string $text Text.
     * @param int $max_length Max length.
     * @return string
     */
    public static function limitWords($text, $max_length) {
        if($text && strlen($text) > $max_length) {
            if($text[$max_length - 1] == ' ') {
                return mb_substr($text, 0, $max_length) . '...';
            } elseif ($text[$max_length] == ' ') {
                return mb_substr($text, 0, $max_length) . '...';
            } else {
                for($i = $max_length - 1; $i > 0 ; $i--) {
                    if($text[$i] == ' ') {
                        return mb_substr($text, 0, $i) . '...';
                    }
                }

                $first_word = explode(' ', $text)[0];

                if(strlen($first_word) > $max_length) {
                    return mb_substr($first_word, 0, $max_length) . '...';
                } else {
                    return $first_word . '...';
                }
            }
        } else {
            return $text;
        }
    }
}
