<?php
/*
Template Name: Home template
*/
get_header();
?>
<div id="primary" class="content-area">
  <div id="content" class="site-content" role="main">
  	<div class="home-content">	    
  		<div class="slider-wrap">
  			<?php echo do_shortcode('[rev_slider home]'); ?>
  		</div>
		<div class="coupon-home-wrap">
      <div class="banner-wrap">
          <div class="banner-left">
            <div class="top-banner">
               <img src="<?php echo get_field('banner_image_1',$post->ID);?>"/>
            </div>
            <div class="bottom-banner">
              <div class="bottom-banner-left">
                <img src="<?php echo get_field('banner_image_2',$post->ID);?>"/>
              </div>
              <div class="bottom-banner-right">
               <img src="<?php echo get_field('banner_image_3',$post->ID);?>"/>
              </div>
           </div>
          </div>
          <div class="banner-right">
            <div class="top-banner-right-top">
               <img src="<?php echo get_field('banner_image_4',$post->ID);?>"/>
            </div>
             <div class="top-banner-right-bottom">
               <img src="<?php echo get_field('banner_image_5',$post->ID);?>"/>
               </div>
          </div>
          </div>
      </div>
		</div>

    <div class="main-ad-banner">
    <div class="ad-banner-box1 box-ad">
    <iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-143840678220534169' frameborder=0 height=250 width=300></iframe></div>
    <div class="ad-banner-box2 box-ad">
     <iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-143840703901180943' frameborder=0 height=250 width=300></iframe>
       </div>
    <div class="ad-banner-box3 box-ad">
     <iframe src='http://www.flipkart.com/affiliate/displayWidget?affrid=WRID-143840701564783511' frameborder=0 height=250 width=300></iframe>
     </div>
      <div class="ad-banner-box4 box-ad">
    <div data-WRID="WRID-143387131791623672" data-widgetType="bestSellers"  data-class="affiliateAdsByFlipkart" height="250" width="300"></div><script async src="//affiliate-static.flixcart.com/affiliate/widgets/FKAffiliateWidgets.js"></script> </div>
    </div>
    </div>
    <div class="logo-slider">
       <?php logo_slider(); ?>
     </div>
	</div>
  </div>
</div>
<?php
get_footer();
?>
