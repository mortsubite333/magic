<?php
/**
 * Some basic handlers for repeditive html elements (e.g. lists, form fields, etc)
 *
 * @author Travis
 */
class HtmlElements {

    /**
     * 	$items:
	 * 	array {
	 * 		array {
	 * 			label: (required)
	 * 			link: (required)
	 * 			class: (optional)
	 * 			children: (optional)
	 * 		}
	 * 	}
     */
    public static function navMenu($items, $id, $class) {
    	$i = 1;
    	foreach($items as $item) {
    		Templater::addVar('id', $id);
			Templater::addVar('class', $class);
    		Templater::addVar('even', $i % 2 == 0 ? 'even' : 'odd');
			Templater::addVar('label', $item['label']);
			if (!empty($item['link']))
				Templater::addVar('link', $item['link']);
			if (!empty($item['class']))
				Templater::addVar('item_class', !empty($item['class']) ? ' '.$item['class'] : '');
			if (!empty($item['children']))
				Templater::addVar('children', $item['children']);
			Templater::addVar('first_iteration', $i == 1);
			Templater::addVar('last_iteration', $i == count($items));
			Templater::addTpl('html/nav_menu');
			$i++;
    	}
    }
	
	/**
	 * $options:
	 * 	array {
	 * 		array {
	 * 			value: (required)
	 * 			label: (optional)
	 * 		}
	 * 	}
	 */
	public static function selectMenu($name, $options, $selected, $multiple = false) {
		$i = 1;
		if (is_array($options)) {
        	foreach ($options as $opt) {
        		Templater::addVar('name', $name);
				Templater::addVar('id', "$name-$i");
				Templater::addVar('value', $opt['value']);
				Templater::addVar('label', !empty($opt['label']) ? $opt['label'] : $opt['value']);
				Templater::addVar('selected', in_array($opt['value'], $selected));
				Templater::addVar('multiple', $multiple);
				Templater::addVar('first_iteration', $i == 1);
				Templater::addVar('last_iteration', $i == count($items));
        		Templater::addTpl('html/select_menu');
				$i++;
        	}
        } else {
            throw new Exception('$options is not an array.');
        }
	}
    
	/**
	 * $options:
	 * 	array {
	 * 		array {
	 * 			value: (required)
	 * 			label: (optional)
	 * 		}
	 * 	}
	 */
    public static function formOptions($name, $options, $checked, $type = 'checkbox') {
		$i = 1;
        if (is_array($options)) {
        	foreach ($options as $opt) {
        		Templater::addVar('name', $name);
				Templater::addVar('id', "$name-$i");
				Templater::addVar('value', $opt['value']);
				Templater::addVar('label', !empty($opt['label']) ? $opt['label'] : $opt['value']);
				Templater::addVar('checked', in_array($opt['value'], $checked));
				Templater::addVar('type', $type);
        		Templater::addTpl('html/form_options');
				$i++;
        	}
        } else {
            throw new Exception('$options is not an array.');
        }
    }
}

?>
