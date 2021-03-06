<?php
/**
 * Single product title.
 *
 * @author     ThemeFusion
 * @copyright  (c) Copyright by ThemeFusion
 * @link       http://theme-fusion.com
 * @package    Avada
 * @subpackage Core
 * @since      5.1.0
 */

$title_size = ( false === avada_is_page_title_bar_enabled( get_the_ID() ) ? '1' : '2' );
?>
<div class="single-title-wrap">
    <h<?php echo esc_attr( $title_size ); ?> itemprop="name" class="product_title entry-title">
        <?php the_title(); ?>
    </h<?php echo esc_attr( $title_size ); ?>>
    <?php 
if(get_field("product_subtitle")):
echo '<h4>'.get_field("product_subtitle").'</h4>';
endif;
?>
</div>