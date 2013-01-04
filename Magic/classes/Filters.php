<?php
/**
 * General variable filters
 *
 * @author Travis
 */
class Filters {
    public static function nl2br($string) {
        if (is_string($string)) {
            return nl2br($string);
        } else {
            throw new Exception("$string is not a string.");
        }
    }
    public static function defValue($expected, $default) {
        if (empty($expected)) {
            return $default;
        } else {
            return $expected;
        }
    }
    public static function htmlEscape($string) {
        if (is_string($string)) {
            return htmlentities($string);
        } else {
            throw new Exception("$string is not a string.");
        }
    }
}

?>
