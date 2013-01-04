<?php
//require "settings.php";
//require "Switchboard/config.php";
require "Magic/config.php";
//$regex = '/^posts\/.*/i';
//echo SwitchBoard::getMain();
//echo preg_match($regex, 'posts/this-blog-post');
Magic::addVar('teststr', 'This is a value');
Magic::addVar('testint', 5);
Magic::addVar('testdouble', 5.1235);
Magic::addVar('testarr', array(5,23,5,array(2,4,6),7,2,1,'test'));
Magic::addVar('testbool', true);
Magic::enableDebugging();
Magic::summon('layout');
?>
