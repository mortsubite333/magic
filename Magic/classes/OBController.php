<?php

class OBController 
{
    public function __construct() {
        return $this->getLevel();
    }
    public function getStatus()
    {
        $status = ob_get_status();
        if (!$status) {
            $this->startNew();
            $status = ob_get_status();
        }
        return $status;
    }

    public function getLevel()
    {
        $status = $this->getStatus();
        return $status['level'];
    }
    
    public function getName()
    {
        $status = $this->getStatus();
        return $status['name'];
    }
    
    public function startNew($callback = null)
    {
        if ($callback !== null && function_exists($callback)) {
            return ob_start($callback);
        } else {
            return ob_start();
        }
    }
    
    public function returnCurrent($end = true)
    {
        $buffer = ob_get_contents();
        if ($end) {
            ob_end_clean();
        }
        return $buffer;
    }
    
    public function outputCurrent($end = true)
    {
        echo $this->returnCurrent($end);
    }
}