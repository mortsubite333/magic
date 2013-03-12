<?php

/**
 * Template date holder class
 */
class Template
{
    const TEMPLATE_EXT = '.tpl.php';
    
    private $name;
    private $rel_path;
    private $abs_path;
    
    public function __construct($rel_path)
    {
        $this->parseRelPath($rel_path);
    }
    
    private function correctDirectorySeparator(&$rel_path)
    {
        $ds = DIRECTORY_SEPARATOR;
        $alt_ds = $ds === '/' ? '\\' : '/';
        if (strpos($rel_path, $ds) && strpos($rel_path, $alt_ds)) { //Path contains both / and \, we don't allow this
            throw new Exception('The path "' . $rel_path . '" is invalid.');
        }
        $rel_path = str_replace($alt_ds, $ds, $rel_path);
        if (substr($rel_path, 0, 1) === $ds) { //make sure the relative path doesn't start with a directory separator
            $rel_path = substr($rel_path, 1);
        }
    }
    
    /**
     * Is my name valid?
     */
    private function parseRelPath(&$rel_path)
    {
        if (!$rel_path || !is_string($rel_path)) {
            throw new Exception('A template name must be passed when adding a new template.');
        }
        if (substr_count($rel_path, self::TEMPLATE_EXT) > 1) {
            throw new Exception("Tried to add an invalid template: $rel_path");
        }
        $this->correctDirectorySeparator($rel_path);
        if (strpos($rel_path, self::TEMPLATE_EXT) === strlen($rel_path) - strlen(self::TEMPLATE_EXT)) {
            $rel_path = str_replace(self::TEMPLATE_EXT, '', $rel_path);
        } elseif (substr($rel_path, -1) === '/') { //Later think about ways to use DIRECTORY_SEPARATOR
            $rel_path = substr($rel_path, 0, strlen($rel_path)-1);
        }
        $this->name = basename($rel_path);
        $rel_path = str_replace($this->name, '', $rel_path);
        $this->rel_path = $rel_path . $this->name . self::TEMPLATE_EXT;
    }
    
    public function existsIn(TemplateFolder $folder)
    {
        $full_path = $folder->getAbsolutePath() . $this->rel_path;
        if (!file_exists($full_path)) {
            return false;
        }
        $this->abs_path = $full_path;
        return true;
    }
    
    public function getAbsolutePath()
    {
        return $this->abs_path;
    }
    
    public function getRelativePath()
    {
        return $this->rel_path;
    }
    
    public function getName()
    {
        return $this->name;
    }
}