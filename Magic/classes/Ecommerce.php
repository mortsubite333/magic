<?php

class Ecommerce {
	
	private static $product_lookup_function = '';
	
	/**
	 * Adjustable strings for different product properties
	 */
	private static $product_id = 'product_id';
	private static $product_name = 'product_name';
	private static $product_image = 'product_image';
	private static $product_description = 'product_description';
	private static $brand_name = 'brand_name';
	private static $brand_logo = 'brand_logo';
	private static $brand_description = 'brand_description';
	
	public static function setBrandDescription($string) {
		if (is_string($string)) {
			Ecommerce::$brand_description = $string;
		} else {
			throw new Exception('Expecting a string.');
		}
	}
	
	public static function setProductLookupFunction($function) {
		if (function_exists($function)) {
			Ecommerce::$product_lookup_function = $function;
		} else {
			throw new Exception("$callback is not defined.");
		}
	}
	
	/**
	 * Either modify this function every time to grab product details, or allow a callback for more dynamic use...
	 */
	public static function product($product_id) {
		if (isset(Ecommerce::$product_lookup_function)) {
			
			$product_attributes = array(
			'product_id' => Ecommerce::$product_id,
			'product_name' => Ecommerce::$product_name,
			'product_image' => Ecommerce::$product_image,
			'product_description' => Ecommerce::$product_description,
			'brand_name' => Ecommerce::$brand_name,
			'brand_logo' => Ecommerce::$brand_logo,
			'brand_description' => Ecommerce::$brand_description,
			);
			
			$product = Ecommerce::$product_lookup_function($product_id);
			
			/*Look for function vs var here*/
			foreach ($product_attrubutes as $k => $v) {
				if (function_exists($function_name))
				Templater::addVar($k, $v);
			}
			
			Templater::addTpl('ecommerce/product_details');
		} else {
			throw new Exception("$callback is not defined.");
		}
	}
}
?>
