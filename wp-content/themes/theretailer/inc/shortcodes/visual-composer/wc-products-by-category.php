<?php

// [product_category]


// product_category_field
function product_category_field($settings, $value) {   
    $categories = get_terms('product_cat'); 
    $dependency = vc_generate_dependencies_attributes($settings);
    $data = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'">';
    foreach($categories as $category) {
        $selected = '';
        if ($value!=='' && $category->slug === $value) {
             $selected = ' selected="selected"';
        }
        $data .= '<option class="'.$category->slug.'" value="'.$category->slug.'"'.$selected.'>' . $category->name . ' (' . $category->count . ' products)</option>';
    }
    $data .= '</select>';
    return $data;
}
add_shortcode_param('product_category' , 'product_category_field');



vc_map(array(
   "name" 			=> __("Products by Category"),
   "category" 		=> __('WooCommerce'),
   "description"	=> __("Slider or Listing"),
   "base" 			=> "products_by_category_mixed",
   "class" 			=> "",
   "icon" 			=> "products_by_category_mixed",
   
   "params" 	=> array(
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Title"),
			"param_name"	=> "title",
			"value" => "Category Title"			
		),
		
		array(
			"type" => "product_category",
			"holder" => "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" => __("Category"),
			"param_name" => "category"
		),
		
		array(
			"type"			=> "textfield",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Number of Products"),
			"param_name"	=> "per_page",
			"value"			=> "12",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Layout Style"),
			"param_name"	=> "layout",
			"value"			=> array(
				"Listing"	=> "listing",
				"Slider"	=> "slider"
			),
			"std"			=> "slider",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Order By"),
			"description"	=> __("Description for Order By."),
			"param_name"	=> "orderby",
			"value"			=> array(
				"None"	=> "none",
				"ID"	=> "ID",
				"Title"	=> "title",
				"Date"	=> "date",
				"Rand"	=> "rand"
			),
			"std"			=> "date",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> __("Order"),
			"description"	=> __("Description for Order."),
			"param_name"	=> "order",
			"value"			=> array(
				"Desc"	=> "desc",
				"Asc"	=> "asc"
			),
			"std"			=> "desc",
		),
   )
   
));