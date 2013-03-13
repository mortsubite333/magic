<?php
//List the variables here, this will be opened in a new window with all available variables
//Could do with a more useful function to print arrays
?>
<? foreach (self::$template_vars as $var => $val): ?>
    <?$type = strtolower(gettype($val))?>
    <?Magic::addVars(array('var'=>$var, 'val'=>$val));?>
    <div class="<?=$type;?>">
    	<span class="name">$<?=$var?></span>
    	<?Magic::addTpl("debug/$type");?>
    </div>
<? endforeach; ?>
