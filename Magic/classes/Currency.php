<?php

/**
 * This class will be in charge of formatting numbers to be displayed as currency.
 * Eventually it may also play a part in converting currency rates
 *
 * @author Travis
 */
class Currency {
    
    private static $include_symbol = false;
    
    private static $symbol = '$';
    
    private static $format = 'US';
    
    public static function includeSymbol(bool $include) {
        if ($include == 'true' || $include == true || $include == 1) {
            Currency::$include_symbol = true;
        } elseif ($include == 'false' || $include == false || $include == 0) {
            Currency::$include_symbol = false;
        }
    }
    
    public static function setSymbol($char) {
        if (strlen($char) == 1) {
            Currency::$symbol = $char;
        }
    }
    
    public static function setFormat($format) {
        Currency::$format = $format;
    }
    
    public static function convert($number) {
        $decimals = 2;
        if (Currency::$format == 'US') {
            $dec_point = '.';
            $thousands_sep = ',';
        } else {
            $dec_point = ',';
            $thousands_sep = '.';
        }
        //Currency::stripIllegalChars($number);
        if (is_numeric($number)) {
            $is_negative = $number < 0;
            $number = abs($number);
            $new_number = number_format($number, $decimals, $dec_point, $thousands_sep);
            if (Currency::$include_symbol) {
                $new_number = Currency::$symbol . $new_number;
            }
            $return = '<span class="currency';
            if ($is_negative) {
                $return .= ' negative';
            }
            $return .= '">' . $new_number . '</span>';
            return $return;
        } else {
            throw new Exception("'" . $number . "' is not a number.");
        }
    }
    
    private static function stripIllegalChars(&$number) {
        $number = preg_replace('/\D/', '', $number);
        echo $number;
        die;
    }
}

?>
