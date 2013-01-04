<?php
//This will be the main debugging window
?>
<div id="debug_window">
	<div class="handle"></div>
    <div id="variables">
        <?Magic::addTpl('debug/variable_list');?>
    </div>
</div>