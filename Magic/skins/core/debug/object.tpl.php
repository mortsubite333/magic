<?
$class = get_class($val);
$methods = get_class_methods($val);
asort($methods);
$variables = get_object_vars($val);
asort($variables)
?>
<span class="object value"><?=$class;?> Object
	<span class="methods">
		<?foreach($methods as $m):?>
			<span><?=$m;?>()</span>
		<?endforeach;?>
	</span>
	<span class="variables">
		<?foreach($variables as $k => $v):?>
		<span class="variable">
			<span class="key">$<?=$k;?></span>&nbsp;->&nbsp;
			<?Magic::addVar('val', $v);?>
			<?Magic::addTpl('debug/'.strtolower(gettype($v)));?>
		</span>
		<?endforeach;?>
	</span>
</span>