<?php
include "classes/Magic.php";

Magic::setTemplatesFolder(getcwd().'/Magic/templates');
Magic::enableTemplating();
Magic::addVar('images_dir', 'Magic/images');
Magic::addVar('js_dir', 'Magic/js');
Magic::addVar('css_dir', 'Magic/css');
?>