<?php

namespace App\Helpers;

// Helper class to do validations on the requests
// This class has been created to work like laravel validation itself
// 'required|min:255|max:255'
use Illuminate\Support\Facades\DB;

class Helpers
{

    /**
     * @param $input
     * @return string|null
     * helper function to do sanitizations
     * escape html characters and escape shell commands
     */
    public static function security_checks($input): ?string
    {
        if ($input == null)
            return null;
        return escapeshellcmd(htmlspecialchars($input));
    }

    /**
     * @param array $fields
     * @return array
     * helper function
     * make validation according to the defined rules and fields
     * check the validaton and set error messages
     */
    public static function make_validation(array $fields): array
    {
        $ret_val = [];

        foreach ($fields as $field_name => $rule_str) {
            $rules = explode('|', $rule_str);
            foreach ($rules as $rule) {
                $rule = trim($rule);

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
                    if (ctype_alpha(str_replace(' ', '', $fld)) === false) {
                        $ret_val[$field_name] = $field_name . ' must be all characters.';
                        break;
                    }
                }
            }
        }
        return $ret_val;
    }

    /**
     * @param string $needle
     * @param string $haystack
     * @return bool
     * helper function
     * check if the string starts with a substring
     */
    public static function starts_with(string $needle, string $haystack): bool
    {
        return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
    }

    /**
     * @param string $rule
     * @return array
     * helper function
     * get the rules and get the values set for the rules
     */
    public static function extract_params(string $rule): array
    {
        $ret_val = [];
        $params = explode(':', $rule);
        foreach ($params as $param) {
            if (is_numeric($param))
                $ret_val[] = trim($param);
        }
        return $ret_val;
    }
}
