<?php

class TemplateFolder
{
    private $abs_path;
    
    public function __construct($abs_path)
    {
        if (!is_dir($abs_path)) {
            throw new Exception("Tried to add a template folder that does not exist: $abs_path");
        }
        if (substr($abs_path, -1) !== DIRECTORY_SEPARATOR) {
            $abs_path .= DIRECTORY_SEPARATOR;
        }
        $this->abs_path = $abs_path;
    }
    
    public function getTemplate($rel_path)
    {
        $template = new Template($rel_path);
        if ($template->existsIn($this)) {
            return $template;
        } else {
            throw new Exception('Unable to find template file "' . $rel_path . '" in folder "' . $this->abs_path . '"');
        }
    }
    
    public function getAbsolutePath()
    {
        return $this->abs_path;
    }
}