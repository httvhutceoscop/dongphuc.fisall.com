<?php


/* Variables *********************************************/

$update_check_int 		= 0; // Time in hours to check file for new version
$theme_page 			= "http://themeforest.net/item/the-retailer-responsive-wordpress-theme/4287447?ref=getbowtied";
$author_name 			= "Get Bowtied";
$author_page 			= "http://www.getbowtied.com";
$docs_page 				= "http://support.getbowtied.com/hc/en-us/articles/200900401-How-to-update-The-Retailer-";
$theme_name 			= "The Retailer";
$theme_slug 			= "theretailer"; //Theme's short name for adding options to database

$remote_file 			= 'http://getbowtied.net/_theme_version/'.$theme_slug.'.txt'; //Address of remote file with version number
$theme_update_notice 	= '<p><strong>Your active theme <a href="'.$theme_page.'" target="_blank">'.$theme_name.'</a> by <a href="'.$author_page.'" target="_blank">'.$author_name.'</a> is outdated</strong>! To avoid any security threats and ensure maximum compatibility with your plugins, please <a href="'.$docs_page.'" target="_blank">update now</a>.</p>';

/*********************************************************/




$theme_data 			= wp_get_theme();
$local_version 			= $theme_data->get( 'Version' );
$update_last_check 		= get_option($theme_slug.'_last_ver_check');
$new_ver_notice 		= get_option($theme_slug.'_new_ver');

function theme_check_ver() {
	
	global $update_check_int, $update_last_check, $new_ver_notice,$theme_slug;
	
	if ($new_ver_notice == true) {
		add_action('admin_notices','theme_new_ver');
	}
	
	$update_check_int_seconds = $update_check_int * 3600;
	
	$now = time();
	
	if ( empty( $update_last_check ) ) {
		
		//first run
		theme_compare_ver();
		add_option($theme_slug.'_last_ver_check', $now);

	} else {
		
		$time_ago = $now - $update_last_check;
		if ( $time_ago > $update_check_int_seconds ) {
			theme_compare_ver();
			update_option($theme_slug.'_last_ver_check', $now);
		}

	}

}

function theme_compare_ver() {
	
	global $remote_file, $local_version, $theme_slug;

	$remote_text_array = wp_remote_get($remote_file);

	if (is_wp_error($remote_text_array) ) {
	   $remote_text = "1.0.0";
	} else {
	   $remote_response_code = $remote_text_array['response']['code'];
	   if ($remote_response_code == "200") {
	   		$remote_text = $remote_text_array['body'];	   		
	   } else {
	   		$remote_text = "1.0.0";
	   }
	}

	//print_r($remote_text_array);
	//echo $remote_text;
	
	if ($remote_text !== false) {
		
		$remote_version = $remote_text;
	
	if ($local_version == $remote_version) {
			
		delete_option($theme_slug.'_new_ver');
		
		} else {
			
			if ( is_numeric(str_replace(".", "", $local_version)) && is_numeric(str_replace(".", "", $remote_version)) ) {
				
				if ( substr_count($local_version, '.') == 0 ) {
					// x -> x.x.x.x
					$local_version = $local_version . '.0.0.0';
				} else if ( substr_count($local_version, '.') == 1 ) {
					// x.x -> x.x.x.x
					$local_version = $local_version . '.0.0';
				} else if ( substr_count($local_version, '.') == 2 ) {
					// x.x.x -> x.x.x.x
					$local_version = $local_version . '.0';
				}

				//---------------//

				if ( substr_count($remote_version, '.') == 0 ) {
					// x -> x.x.x.x
					$remote_version = $remote_version . '.0.0.0';
				} else if ( substr_count($remote_version, '.') == 1 ) {
					// x.x -> x.x.x.x
					$remote_version = $remote_version . '.0.0';
				} else if ( substr_count($remote_version, '.') == 2 ) {
					// x.x.x -> x.x.x.x
					$remote_version = $remote_version . '.0';
				}

				//---------------//

				//echo $remote_version . ' - ' . $local_version . '<br />';
				
				if ( $remote_version > $local_version ) {
					add_action('admin_notices','theme_new_ver');
					add_option($theme_slug.'_new_ver',true);
				} else {
					delete_option($theme_slug.'_new_ver');
				}

			} else {
				add_action('admin_notices','theme_new_ver');
				add_option($theme_slug.'_new_ver',true);
			}
		
		}
	
	} else {
		//echo "Can't Connect to update server";
	}
}	

function theme_new_ver() { 
	global $theme_update_notice, $pagenow;
	?>

		<div class="error">
		<?php echo $theme_update_notice; ?>
		</div>

	<?php
}

add_action('admin_head','theme_check_ver'); //Theme Update Function

/****************************
Inspired By Jeremy Clark
*****************************/

?>