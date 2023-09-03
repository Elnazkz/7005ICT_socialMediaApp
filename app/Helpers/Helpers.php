<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class Helpers {
    /**
     * @throws \Exception
     */
    public static function make_validation(array $fields) : array {
        $ret_val = [];
        if (!isset($_POST))
            throw new \Exception("$_POST is not defined !");

        foreach ($fields as $field_name => $rule_str) {
            $rules = explode('|', $rule_str);
            foreach ($rules as $rule) {
                $rule = trim($rule);

                if ((!isset($_POST[$field_name])) || ($_POST[$field_name]) === null)
                    throw new \Exception("Bad " . $field_name . " is not defined !");
                else
                    $fld = trim($_POST[$field_name]);

                if ($rule == 'required') {
                    if ($fld === "") {
                        $ret_val[$field_name] = $field_name . ' is required.';
                        break;
                    }
                } else if (self::starts_with('min', $rule)) {
                    $rule = substr($rule, strlen('min'));
                    $param = self::extract_params($rule)[0];
                    $param = intval($param);
                    if (strlen($fld) < $param) {
                        $ret_val[$field_name] = $field_name . ' must be at least ' . strval($param) . ' chars.';
                        break;
                    }
                } else if (self::starts_with('words', $rule)) {
                    $rule = substr($rule, strlen('words'));
                    $param = self::extract_params($rule)[0];
                    $param = intval($param);
                    if (str_word_count($fld) < $param) {
                        $ret_val[$field_name] = $field_name . ' must be at least ' . strval($param) . ' words.';
                        break;
                    }
                } else if (self::starts_with('alpha', $rule)) {
                    if (!ctype_alpha($fld)) {
                        $ret_val[$field_name] = $field_name . ' must be all alpha.';
                        break;
                    }
                } else {
                    throw new \Exception("Bad rule string '" . $rule . "'");
                }
            }
        }
        return $ret_val;
    }

    public static function starts_with(string $needle, string $haystack) : bool {
        return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
    }

    public static function extract_params(string $rule) : array {
        $ret_val = [];
        $params = explode(':', $rule);
        foreach ($params as $param) {
            if (is_numeric($param))
                $ret_val[] = trim($param);
        }
        return $ret_val;
    }
}
