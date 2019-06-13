<?php
/* 
Description : Woocommerce Single Product Custom
Author : Bongjour

*/

add_action( 'woocommerce_before_single_product', 'bbloomer_custom_action', 15 );
function bbloomer_custom_action() {    
      echo '<h3 class="common-tit">수강신청 <em>김면수국어의 수강을 신청합니다</em></h3>';
}
/* Remove product meta */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/* Single Product Stock Badge */
add_action( 'woocommerce_product_thumbnails', 'stock_badge', 10 );
function stock_badge() {
      global $product;
      if ( $product->is_in_stock() ) {
            echo '<span class="btn-badge stock"><span class="table-cell">수강<br/>신청중</span></span>';
      }else{
            echo '<span class="btn-badge outofstock"><span class="table-cell">신청마감</span></span>';
      }
}