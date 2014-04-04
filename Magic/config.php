<?php
include "classes/Magic.php";
Magic::setRootFolder(getcwd().'/Magic/');
Magic::setTemplatesFolder(getcwd().'/Magic/templates');
Magic::loadLanguages();
//Magic::enableTemplating();
//Magic::enableDebugging();
$images_dir = 'Magic/images';
Magic::addVar('images_dir', $images_dir);
Magic::addVar('js_dir', 'Magic/js');
Magic::addVar('css_dir', 'Magic/css');
?>