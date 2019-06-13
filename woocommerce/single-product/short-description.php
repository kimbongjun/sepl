<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  Automattic
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
global $product;
$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}
?>

<div class="post-content woocommerce-product-details__short-description">
    <ul class="w_custom_list">
        <?php if($short_description):?>
        <li>
            <dl>
                <dt>수강일정</dt>
                <dd>
                    <?=$short_description;?>
                </dd>
            </dl>
        </li>
        <?php endif;?>
        <?php if($product->get_price_html()): ?>
        <li>
            <dl>
                <dt>수강료</dt>
                <dd><span class="w_price"><?php echo $product->get_price_html(); ?></span> <span
                        style="font-weight: 400;">(VAT 포함)</span></dd>
            </dl>
        </li>
        <?php endif;?>
        <?php if(get_field("peoples")): ?>
        <li>
            <dl>
                <dt>수강정원</dt>
                <dd>
                    <?=get_field("peoples");?> 명
                </dd>
            </dl>
        </li>
        <?php endif;?>
    </ul>
</div>