<?if($first_iteration):?>
<label for="<?=$id?>"><?=$label?></label>
<select id="<?=$id?>" name="<?=$name?>"<?if($multiple):?> multiple<?endif;?>>
<?endif;?>
	<option value="<?=$option_value?>"<?if($selected):?> selected<?endif;?>><?=$option_label?></option>
<?if($last_iteration):?>
</select>
<?endif;?>
