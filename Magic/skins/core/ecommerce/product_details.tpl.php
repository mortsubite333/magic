<article class="product">
	<h1><?=$product_name?></h1>
	<div class="image-container">
		<img alt="<?=$product_name?>" src="<?=$product_image?>" />
	</div>
	<section class="description">
		<?=$product_description?>
	</section>
	<section class="manufacturer">
		<h2><?=$brand_name?></h2>
		<img alt="<?=$brand_name?>" src="<?$brand_logo?>" />
		<span><?=$brand_description?></span>
	</section>
	<section class="order_form">
		<!-- should use a different template for the form -->
		<form name="order">
			<input type="hidden" name="product_id" value="<?=$product_id?>" />
			<input type="hidden" name="quantity" value="1" />
			<input type="submit" name="submit" value="Purchase" />
		</form>
	</section>
</article>

<div>
    <h4>One more level!</h4>
    <?Magic::addVar('brand_name', 'This was overwritten again'); ?>
    <?Magic::addTpl('ecommerce/test');?>
</div>
