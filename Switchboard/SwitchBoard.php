<?php
/**
 * Checks database for matching entity of the url given, and returns the correct page.
 *
 * @author Travis
 */
class SwitchBoard {
    
    protected static $main;
    protected static $sub_section;
    protected static $entity;
    protected static $additional_params;
    
    private static function trimSlashes(&$request_path) {
        if (substr($request_path, 0, 1) == '/') {
            $request_path = substr($request_path, 1);
        }
        if (substr($request_path, -1) != '/') {
            $request_path .= '/';
        }
    }
    
    public static function init() {
        $request = parse_url($_SERVER['REQUEST_URI']);
        // should now try and figure out what type of page it is, then let the page parse it's parts
        // could implement a way for new page types to show Switchboard how to recognize it
        self::select_parts($request);
    }
    
    private static function select_parts($request_path) {
        extract($request_path, EXTR_PREFIX_ALL,'request');
        self::trimSlashes($request_path);
        $request_path = explode('/', $request_path);
        self::$main = array_shift($request_path);
        if (str_replace('/', '', self::$main) == str_replace('/', '', WEB_DIR)) {
            self::$main = array_shift($request_path);
        }
        self::$sub_section = array_shift($request_path);
        self::$entity = array_shift($request_path);
        self::$additional_params = $request_path;
    }

    public static function getMain() {
        return self::$main;
    }
}
?>
