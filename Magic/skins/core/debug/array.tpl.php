<span class="array value">
<?if($val):?>
	<br>
	<?foreach($val as $k => $v):?>
	<span class="variable">
		<span class="key"><?=$k;?></span>&nbsp;=>&nbsp;
			<?Magic::addVar('val', $v);?>
			<?Magic::addTpl('debug/'.strtolower(gettype($v)));?>
	</span>
	<?endforeach;?>
<?endif;?>
</span>