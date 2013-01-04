<?php
namespace Switchboard;
/**
 * Description of Page
 *
 * @author Travis
 */
class Page {

    protected static $main;
    protected static $sub_section;
    protected static $entity;
    protected static $additional_params;
    
    private function trimSlashes(&$request_path) {
        if (substr($request_path, 0, 1) == '/') {
            $request_path = substr($request_path, 1);
        }
        if (substr($request_path, -1) == '/') {
            $request_path = substr($request_path, 0, -1);
        }
    }
    
    public function __construct($request_path) {
        extract($request_path, EXTR_PREFIX_ALL,'request');
        $this->trimSlashes($request_path);
        $request_path = explode('/', $request_path);
        self::$main = array_shift($request_path);
        if (str_replace('/', '', self::$main) == str_replace('/', '', WEB_DIR)) {
            self::$main = array_shift($request_path);
        }
        self::$sub_section = array_shift($request_path);
        self::$entity = array_shift($request_path);
        self::$additional_params = $request_path;
    }

    public function getMain() {
        return self::$main;
    }

    public function getSubSection() {
        return self::$sub_section;
    }

    public function getEntity() {
        return  self::$entity;
    }

}

?>
