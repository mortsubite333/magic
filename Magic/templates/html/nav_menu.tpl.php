<?if($first_iteration):?>
<ul<?if($id):?> id="<?=$id?>"<?endif;?><?if($class):?> class="<?=$class?>"<?endif;?>>
<?endif;?>
	<li class="<?=$even?><?=$item_class?>">
		<a href="<?=$link?>"><?=$label?></a>
		<?if(!empty($children)){Templater::navMenu($children);}?>
	</li>
<?if($last_iteration):?>
</ul>
<?endif;?>
