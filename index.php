<?php
require "Magic/classes/OBController.php";
require "Magic/classes/Magic.php";
require "Magic/classes/Template.php";
require "Magic/classes/Skin.php";
define('WEB_ROOT', getcwd());
require './Magic/config.php';
/*$main_templates = new TemplateFolder(MAGIC_ROOT.'templates');
$head = $main_templates->getTemplate('html/select_menu');
print_r($head);*/
$m = Magic::init();
var_dump($m);
die;

Magic::addVar('teststr', 'This is a value');
Magic::addVar('testint', 5);
Magic::addVar('testdouble', 5.1235);
Magic::addVar('testarr', array(5,23,5,array(2,4,6),7,2,1,'test'));
Magic::addVar('testbool', true);
Magic::enableDebugging();
Magic::summon('layout');
?>
