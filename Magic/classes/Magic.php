<?php

class Magic {

    private static $instance = null;
    private $ob = null; //Holds the OBController
    private $main_skin = null; //Holds the standart Skin - how to load this automatically... Config files!
    private $second_skin = null; //Holds the custom Skin, which will overwrite any template files contained in $main_skin
    
    public static function &init()
    { //Should probably set up some sort of config, or at least read from it
        if (self::$instance === null) {
            self::$instance = new Magic();
        }
        return self::$instance;
    }
    
    private function __construct()
    {
        $this->ob = new OBController();
    }
    
    public static function __callStatic($name, $args)
    {
        if(method_exists(self::$instance, $name)) {
            self::$instance->$name($args);
        }
    }
    
    private function template($rel_path)
    {
    
    }
    
    public function loadSkin(Skin $skin) // This should load the skin XML definition file, and create the Skin object from there
    {
    
    }

    /*private static $page = '';
    private static $template_blocks = array();
    private static $template_vars = array();
    private static $secondary_template_vars = array();
    private static $templating_on = false;
    private static $debugging_on = false;
    private static $templates_folder = '';
    private static $root_folder = '';
    private static $ob_start_level = null;
    private static $capturing = false;
    private static $return_next = false;

    public static function setTemplatesFolder($path) {
        self::$templates_folder = $path;
        if (substr($path, -1) != '/') {
            self::$templates_folder .= '/';
        }
    }

    public static function setRootFolder($path) {
        self::$root_folder = $path;
        if (substr($path, -1) != '/') {
            self::$root_folder .= '/';
        }
    }

    public static function openSpellbooks() {
        self::loadLanguages();
    }

    public static function loadLanguages() {
        global $lng;
        if (!isset($lng)) {
            $lng = array();
        }
        $lng_folder = self::$root_folder . 'lng';
        $folder = new DirectoryIterator($lng_folder);
        foreach ($folder as $file) {
            if (!$file->isDot() && !$file->isDir() && $file->getExtension() == 'lng') {
                $lng_array = parse_ini_file($file->getPathname());
                $lng[$file->getBasename('.lng')] = $lng_array;
            }
        }
    }

    public static function cast($name, $value, $overwrite = false) {
        self::addVar($name, $value, $overwrite);
    }

    public static function addVar($name, $value, $overwrite = false) {
        if (!self::$capturing || $overwrite) {
            self::$template_vars[$name] = $value;
        } else {
            self::$secondary_template_vars[ob_get_level() + 1][$name] = $value;
        }
    }

    public static function addVars($var_array) {
        if (is_array($var_array)) {
            foreach ($var_array as $name => $value) {
                self::addVar($name, $value);
            }
        } else {
            throw new Exception('addVars expects an array.');
        }
    }

    protected static function handleBuffer($output) {
        $ob = ob_get_status();

        if ($ob['name'] == __CLASS__ . '::' . __FUNCTION__ && $ob['level'] > self::$ob_start_level && !self::$return_next) {
            self::$capturing = true;
        } else {
            self::$capturing = false;
		self::$return_next = false;
	}
        return $output;
    }

    protected static function startCapture($template) {

        ob_start(array(__CLASS__, 'handleBuffer'));
    }

    protected static function endCapture($template) {
        $temp = ob_get_clean();
        if (self::$capturing) {
            //self::$template_blocks[$template][] = $temp; //just eating memory for now
            echo $temp;
        } else {
            return $temp;
        }
    }

    public static function invoke($template) {
        self::addTpl($template);
    }

    public static function addTpl($template) { // This function should throw a different exception with a desired resource name
        $tpl_file = self::$templates_folder . $template . self::TEMPLATE_EXT;
        if (file_exists($tpl_file)) {
            self::startCapture($template);
            if (self::$templating_on) {
                $tpl_num = count(self::$template_blocks[$template]);
                $tpl_num = $tpl_num > 0 ? $tpl_num . ' ' : '';
                echo "\n<!-- Begin " . $template . self::TEMPLATE_EXT . " $tpl_num-->\n";
            }
            if (is_array(self::$template_vars) && !empty(self::$template_vars)) {
                extract(self::$template_vars);
            }
            if (is_array(self::$secondary_template_vars) && !empty(self::$secondary_template_vars)) {
                foreach (self::$secondary_template_vars as $k => $v) {
                    if ($k <= ob_get_level()) {
                        extract($v);
                    }
                    if ($k > ob_get_level()) {
                        unset(self::$secondary_template_vars[$k]);
                    }
                }
            }
            include $tpl_file;
            if (self::$templating_on) {
                echo "\n<!-- End " . $template . self::TEMPLATE_EXT . " $tpl_num-->\n";
            }
            return self::endCapture($template);
        } else {
            throw new Exception('Template file not found.');
        }
    }

    public static function loadMain($main) {
        try {
            self::addTpl($main);
        } catch (Exception $e) {
            self::addTpl('404');
        }
    }

    public static function output() {
        echo self::$page;
    }

    public static function summon($path) {
        if (self::$ob_start_level == null) {
            self::$ob_start_level = ob_get_level();
        }
	ksort(self::$template_vars);
        self::addTpl($path);
        self::output();
    }

    public static function returnSummon($path) {
    	self::$return_next = true;
        return self::addTpl($path);
    }

    public static function enableTemplating() {
        self::$templating_on = true;
    }

    public static function disableTemplating() {
        self::$templating_on = false;
    }
    
    public static function enableDebugging() {
        self::$debugging_on = true;
    }
    
    public static function disableDebugging() {
        self::$debugging_on = false;
    }
    
    public static function debugMode() {
        return self::$debugging_on;
    }
    
    public static function printArray($a) {
        foreach ($a as $k => $v) {
            if (is_array($v)) {
                echo "<span class='value'><br>";
                self::printArray($v);
                echo "</span>";
            } else {
                echo "[$k]&nbsp;=>&nbsp;$v<br>";
            }
        }
    }

    public static function navLink($name, $value) {
        $params = array_merge($_GET, array($name => $value));
        return http_build_query($params);
    }

    // Conversion/filter functions under here
    public static function currency($number) {
        echo Currency::convert($number);
    }

    //Filters
    public static function nl2br($string) {
        echo Filters::nl2br($string);
    }

    public static function defValue($expected, $default) {
        echo Filters::defValue($expected, $default);
    }

    public static function htmlEscape($string) {
        echo Filters::htmlEscape($string);
    }

    //HtmlElements
    public static function navMenu($array, $id = '', $class = '') {
        echo HtmlElements::navMenu($array, $id, $class);
    }

    public static function checkBoxes($name, $options, $checked = array()) {
        HtmlElements::formOptions($name, $options, $checked, $type = 'checkbox');
    }

    public static function radioButtons($name, $options, $checked = array()) {
        if (count($checked) <= 1) {
            HtmlElements::formOptions($name, $options, $checked, $type = 'radio');
        } else {
            throw new Exception('Only one radio button can be checked, multiple passed in via $checked.');
        }
    }*/

}
