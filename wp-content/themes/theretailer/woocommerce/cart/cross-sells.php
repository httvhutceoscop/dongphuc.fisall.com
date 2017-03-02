<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce_loop, $woocommerce, $product;

$crosssells = $woocommerce->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> 12,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $crosssells
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= 2;

if ( $products->have_posts() ) : ?>    
    
    <?php $sliderrandomid = rand() ?>
    
    <script>
	jQuery(document).ready(function($) {
		
		var cross_sells_slider = $("#cross-sells-<?php echo $sliderrandomid ?>");
		
		if ( $(".gbtr_items_slider_id_<?php echo $sliderrandomid ?>").parents('.wpb_column').hasClass('vc_span6') ) {
			
			cross_sells_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsMobile : false,
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
			
		} else {
		
			cross_sells_slider.owlCarousel({
				items:4,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: [770,3],
				itemsMobile : [480,2],
				lazyLoad : true,
				/*autoHeight : true,*/
			});
			
		}
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			cross_sells_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			cross_sells_slider.trigger('owl.next');
		})
		
	});
	</script>
    
    <br /><br />
    
    <div class="grid_12">
    
        <div class="slider-master-wrapper cross_sells_section gbtr_items_slider_id_<?php echo $sliderrandomid ?>">
            
            <div class="gbtr_items_sliders_header">
                <div class="gbtr_items_sliders_title">
                    <div class="gbtr_featured_section_title"><strong><?php _e('You may also like&hellip;', 'woocommerce') ?></strong></div>
                </div>
                <div class="gbtr_items_sliders_nav">                        
                    <a class='big_arrow_right'></a>
                    <a class='big_arrow_left'></a>
                    <div class='clr'></div>
                </div>
            </div>
            
            <div class="gbtr_bold_sep"></div>   
        
            <div class="slider-wrapper">
				<div class="slider" id="cross-sells-<?php echo $sliderrandomid ?>">
				
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
	
						<ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
		
					<?php endwhile; // end of the loop. ?>
                
				</div><!--.slider-->
			</div><!--.slider-wrapper-->
        
        </div>
    
    </div>   

<?php endif;

wp_reset_postdata();