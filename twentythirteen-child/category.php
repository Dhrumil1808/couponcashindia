<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

get_header(); ?>
<?php 

    $name=get_queried_object()->name;
    //echo $name;
    $json = file_get_contents("http://api.dataweave.in/v1/coupons/listByStore/?api_key=2588ea5c812f9a4c808ede5ca5bfbbb0292eea96&store=".$name."&page=1&per_page=20",0,null,null);
    $json_output = json_decode($json,true);
  ?>
  <div class="product-wrap-box">
    <div class="sidebar-wrap">
    
    </div>
  <div class="coupon-wrap product-wrap">
    <section class="store-details">
      <?php $image = get_field('cat-image', get_queried_object()->taxonomy.'_'.get_queried_object()->term_id); ?>
      <img src="<?php echo $image; ?>" width="200px" height="200px">
      <p class="store-count"><?php echo $name;?> Coupons - 20<?php //echo $json_output[count]; ?> Offers </p>
    </section>
     <section class="coupon-details">
      <h2 class="all_inner_hd">MOST POPULAR  <?php echo $name;?>  COUPONS  WITH CASHBACK</h2>
      <section class="store_module-wrap">
        <?php foreach ($json_output[data] as $value) {
         ?>
        <article class="store_module">
          <p class="ad-details">
            <?php  echo $value[coupon_description]; ?>
          </p>
          <a class="grab-details" href="<?php echo $value[coupon_link]; ?>"><input type="button" value="Grab deal" class="button"></a>

         <span class="fr expires pos"><?php echo $value[last_tested]; ?></span>
         <!--  <ul class="fw">
            <li></li> -->
           <!--  <li>|</li>
            <li><a data-id="1017_165806" href="javascript:void(0);" class="store_tool_tip">How to get this Offer</a></li>
            <li>|</li>
            <li><a data-id="terms_165806" href="javascript:void(0);" class="terms_tool_tip">Terms &amp; Conditions</a></li>
          --> <!-- </ul> -->
        </article>
        <?php  
        } ?>
      </section>
    </section>
  </div>
</div>
<?php get_footer(); ?>
