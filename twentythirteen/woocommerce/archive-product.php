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
session_start();
get_header();
global $current_user; ?>

<!-- //popup code -->
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/custom.js"></script>
<link rel="stylesheet" href="http://couponcashindia.com/wp-content/themes/twentythirteen/cssbackup/style.css" type="text/css"> </link>
<?php include('popup_custom.php'); ?>



<?php 
//fillrer array
$store=array();
$brands=array();
$color=array();
$category=array();

if(isset($_GET['high_val']) && isset($_GET['low_val']))
{
  $high_val=($_GET['high_val']*100);
  $low_val=($_GET['low_val']*100);
}

$name=get_queried_object()->name;
//$category=get_queried_object();
//echo $name."<br>";
//echo $category."<br>";
//Include the class.
include "api/clusterdev.flipkart-api.php";
$flipkart = new \clusterdev\Flipkart("ikkakkarg", "b4d899badf1e4a8e923d99376e497306", "json");
$details1 = $flipkart->call_url('https://affiliate-api.flipkart.net/affiliate/search/json?query='.$name.'&resultCount=100');
//print_r($details1);
if(!$details1){
  // echo 'Error: Could not retrieve products list.';
  // exit();
}
$details1 = json_decode($details1, TRUE);
// echo '<pre>';
 //print_r($details1);
// echo '</pre>';

$products = $details1['productInfoList'];
//print_r($products)."<br>";
$product_array=array();

//Make sure there are products in the list.
if(count($products) > 0){
  $store[]="Flipkart";
  foreach ($products as $product) {

    //Hide out-of-stock items unless requested.
    $inStock = $product['productBaseInfo']['productAttributes']['inStock'];
    if(!$inStock && $hidden)
      continue;
    
    
    $productId = $product['productBaseInfo']['productIdentifier']['productId'];
    $title = $product['productBaseInfo']['productAttributes']['title'];
    $productDescription = $product['productBaseInfo']['productAttributes']['productDescription'];
    $productcategory=$product['productBaseInfo']['productIdentifier']['categoryPaths']['categoryPath'][0][0]['title'];
      //print_r($product['productBaseInfo']['productAttributes']['imageUrls']);
    //We take the 200x200 image, there are other sizes too.
    $productImage = array_key_exists('400x400', $product['productBaseInfo']['productAttributes']['imageUrls'])?$product['productBaseInfo']['productAttributes']['imageUrls']['400x400']:'';
    $sellingPrice = $product['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
    $productUrl = $product['productBaseInfo']['productAttributes']['productUrl'];
    $productBrand = $product['productBaseInfo']['productAttributes']['productBrand'];
    $color = $product['productBaseInfo']['productAttributes']['color'];
    //$productUrl = $product['productBaseInfo']['productAttributes']['productUrl'];
   // print_r($productcategory)."<br>";
    
    $productImages=explode(',',$productImage);
    if(isset($_GET['high_val']) && isset($_GET['low_val']))
    {
     if(($sellingPrice<=($high_val/100)) && ($sellingPrice>=($low_val/100)))
        {
          $product_array[] = array (
              "id"  =>$productId,
              "title"=>$title,
              "productImage"=>$productImages,
              "sellingPrice"=>'Rs. '.$sellingPrice,
              "productBrand"=>$productBrand,
              "productUrl"=>$productUrl,
              "offer_price"=>$offer_price,
              "price"=>$sellingPrice,
              "category"=>$productcategory,
              'store'=>'Flipkart'
              );
          $brands[]=$productBrand;
          $category[]=$productcategory;
        }
      }
        else{
          $product_array[] = array (
              "id"  =>$productId,
              "title"=>$title,
              "productImage"=>$productImages,
              "sellingPrice"=>'Rs. '.$sellingPrice,
              "productBrand"=>$productBrand,
              "productUrl"=>$productUrl,
              "offer_price"=>$offer_price,
              "price"=>$sellingPrice,
              "category"=>$productcategory,
              'store'=>'Flipkart'
              );
          $brands[]=$productBrand;
           $category[]=$productcategory;
        }
  }
}



include('api/amazon_api.php');
 $store[]="Amazon";
for ($j=1; $j <50 ; $j++) { 
  $show = amazon_get_signed_url1($name,$j);
$ch = curl_init($show);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
$c = curl_exec($ch);
$xml = simplexml_load_string($c);
$json = json_encode($xml);
$array = json_decode($json,TRUE);
//print_r($array)."<br>";
//print_r($array[Items][Item][0][BrowseNodes][BrowseNode][Ancestors][BrowseNode][Ancestors][BrowseNode][Name])."<br>";
//echo count($array[Items][Item][0][BrowseNodes][BrowseNode][Ancestors][BrowseNode][Name]);
$checkamazon = $array[Items][Item][0][DetailPageURL];
if($checkamazon != ""){
}
for($i=0;$i<10;$i++){
  $aid=$array[Items][Item][$i][ASIN];
  $brand=$array[Items][Item][$i][ItemAttributes][Brand];
  $aprice = $array[Items][Item][$i][ItemAttributes][ListPrice][FormattedPrice];
  $amount=$array[Items][Item][$i][ItemAttributes][ListPrice][Amount];
  $aDescription = $array[Items][Item][$i][ItemAttributes][Title];
  $aUrl = $array[Items][Item][$i][DetailPageURL];
  $aImage = $array[Items][Item][$i][LargeImage][URL];
  $offer_price=$array[Items][Item][$i][ItemAttributes][OfferSummary][LowestNewPrice][FormattedPrice];
  $categorys=$array[Items][Item][0][BrowseNodes][BrowseNode][Ancestors][BrowseNode][Ancestors][BrowseNode][Name];
   if($amount=='')
    continue;
  if($aUrl != ""){
   if(isset($_GET['high_val']) && isset($_GET['low_val']))
      {
      if($amount<=$high_val && $amount>=$low_val)
       {
            $product_array[] = array (
                      "id"  =>$aid,
                      "title"=>substr($aDescription,0,120),
                      "productImage"=>$aImage,
                      "sellingPrice"=>$aprice,
                      "productBrand"=>$brand,
                      "productUrl"=>$aUrl,
                      "offer_price"=>$offer_price,
                      "price"=>$amount,
                      "category"=>$categorys,
                      'store'=>'Amazon'
                      );
            $brands[]=$brand;
            $category[]=$categorys;
        }
      }
     else{
         $product_array[] = array (
                    "id"  =>$aid,
                    "title"=>substr($aDescription,0,120),
                    "productImage"=>$aImage,
                    "sellingPrice"=>$aprice,
                    "productBrand"=>$brand,
                    "productUrl"=>$aUrl,
                    "offer_price"=>$offer_price,
                    "price"=>$amount,
                    "category"=>$categorys,
                    'store'=>'Amazon'
                    );
         $brands[]=$brand;
         $category[]=$categorys;
       }
   }
}
}


$brands= array_unique($brands);
$store=array_unique($store);
$category=array_unique($category);

  ?>
 <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <div class="product-wrap-box">
            <div class="sidebar-wrap">
            
            <section class="side_product_category">
            <h3> CATEGORY </h3>
            <div class="side_show pb">
            <form id="form2" method="get" action="">
            <?php foreach ($category as $c) {      
              if(empty($c) || $c=="Categories")
              {

               
                continue;
              }
              else
              {
                
                ?>
                <div class="checkbox-wrap">
                <input type="checkbox" onchange="jQuery('#form2').submit();" name="category[]" value="<?php echo $c;?>" class="checkbox"/> <?php echo $c; ?> </input> 
                </div>
                <?php
            }
          
          }
            ?>
            </form>
            </div>
            </section>
              <section class="side_product_price">
                 <h3>PRICE</h3><div class="side_show pb">
                  <p class="txt">Enter a price range</p>
                  <p>
                  <form method="get" action="">
                    <input type="text" value="<?php echo $_GET['low_val']; ?>" class="fl" data-val="<?php echo $_GET['low_val']; ?>" id="low_val" name="low_val">
                    <span class="fl">-</span>
                    <input type="text" value="<?php echo $_GET['high_val']; ?>" id="high_val" data-val="<?php echo $_GET['high_val']; ?>" class="fl" name="high_val">
                    <input type="submit" value="Go" class="fr" id="btnPrice" name=""></p>
                  </form>
                  </div>
                  </section>
                   <section class="side_product_store">
                  <h3>STORE </h3><div class="side_show pb">  
                  <form id="form" method="get" action="">
                    <?php foreach ($store as $s) {
                      ?>
                       <div class="checkbox-wrap">
                       <input type="checkbox" onchange="jQuery('#form').submit();"  name="store[]" value="<?php echo $s; ?>" 
                       <?php //if(isset($_GET['store'][0]) && ($_GET['store'][0]==$s) ) echo 'checked="checked"';?> class="checkbox"/><?php echo $s; ?></input>
                       </div>
                     <?php
                    }
                   ?>
                    </form>
                  </section>
                    <section class="side_product_brand">
                  <h3>BRAND</h3><div class="side_show pb">  
                  <form id="form1" method="get" action="">
                    <?php foreach ($brands as $b) {
                      if(empty($b))
                      {
                        continue;
                      }
                      else
                      {

                      ?>
                      <div class="checkbox-wrap">
                       <input type="checkbox" onchange="jQuery('#form1').submit();"  name="brands[]" value="<?php echo $b; ?>" <?php //if(isset($_GET['brands'][0]) && ($_GET['brands'][0]==$b)) echo 'checked="checked"';?> class="checkbox"/><?php echo $b; ?></input>
                      </div>
                     <?php
                    }
                  }
                   ?>
                    </form>
                  </div>
              </section>
            </div>
            <div class="product-wrap">
              <?php 
                $i=0;
                $j=0;
                $k=0;
                foreach ($product_array as $value) {
                  $brandname=$_GET['store'][0];
                  //echo $brandname."<br>";
                  $storename=$_GET['brands'][0];
                  //echo $storename."<br>";
                  $categoryname=$_GET['category'][0];
                  //echo $value[category]."<br>";
                  //echo $_GET['category'][0];
                  //echo $categoryname."<br>";
                  //echo $value[store]."<br>";
                  //echo $value[productBrand]."<br>";
                  //echo $value[productcategory];
                  if(isset($_GET['store'][0]))
                  {        
                    if( $_GET['store'][0]!=$value[store]) {
                      // echo 'noteual';
                      // echo $_GET['store'][0].'//$value[store]='.$value[store].'<br>';
                      continue;
                     
                    }
                    else{
                       
                    }
                    
                  }
                  else if(isset($_GET['brands'][0]))
                  {
                    if($_GET['brands'][0] != $value[productBrand] ) {
                      // echo 'noteual';
                      // echo $_GET['brands'][0].'//$value[store]='.$value[productBrand].'<br>';
                      continue;
                   }
                  }
                  else if(isset($_GET['category'][0]))
                  {
                    if($_GET['category'][0] != $value[category])
                    {
                      continue;

                    }
                  }
                  //die;
                  $image_url='';
                  if($value[store]=='Flipkart') {
                    if(is_array($value[productImage]))
                    {
                      if($value[productImage][0]!='')
                      {
                        $image_url=$value[productImage][0];
                      }
                      else if($value[productImage][1]!='')
                      {
                        $image_url=$value[productImage][1];
                      }
                    }
                    else{
                      $image_url=$value[productImage];
                    }
                  }
                  else{
                    $image_url=$value[productImage];
                  }
                  if($image_url=='') continue;
                ?>
              <div class="each-product">
                <div class="image-wrap">
                  <img src="<?php  echo $image_url; ?>" width="200px" height="200px">
                </div>
                <div class="details-wrap">
                  <p class="title"><a href=""><?php echo substr($value[title],0,120); ?></a></p>
                  <p class="bye-from">Buy from :<?php echo $value[store]; ?></p>
                  <div class="price"><span class="sell-price"><?php echo $value[sellingPrice]; ?></span>
                    <span class="off-price"><?php ?></span></div>
                    <?php if(get_field('cashback',get_queried_object()->taxonomy.'_'.get_queried_object()->term_id)){ ?>
                    <div class="cashback"><?php echo '+ FLAT '.get_field('cashback',get_queried_object()->taxonomy.'_'.get_queried_object()->term_id).'% CASHBACK';?></div>
                    <?php } ?>
                     <?php if ( is_user_logged_in() ) { 
                        if($value[store]=='Flipkart') {
                      ?>
                       <!-- <p class="flat-off"><a target="_blank" href="<?php echo $value[productUrl].'&affid=Affiliate247&aff_sub='.$current_user->ID;?>">See Details</a></p> -->
                      <?php }else{ ?>
                       <!-- <p class="flat-off"><a target="_blank" href="<?php echo $value[productUrl].'&aff_sub='.$current_user->ID;?>">See Details</a></p> -->
                     
                        <?php
                        }
                      }

                  else{ ?>
                  <p class="flat-off"><a id="">See Details</a>
                  <?php } ?>
                   <?php 
                   if ( is_user_logged_in() ) {   
                      if($value[store]=='Flipkart') {
                        ?>   
                   <!--  <a target="_blank" href="<?php //echo $value[productUrl].'&affid=Affiliate247&aff_sub='.$current_user->ID;?>"> -->
                      <a target="_blank" href="#" id="aff-click" value=<?php echo $k++;?> aff-url="<?php echo $value[productUrl];?>" store="<?php echo $value[store];?>">
                      <input type="button" class="button"  value="Grab deal" /></a>
                    <?php }  else{ ?>
                      <a target="_blank"  href="#" id="aff-click" value=<?php echo $k++;?> aff-url="<?php echo $value[productUrl];?>" store="<?php echo $value[store];?>">
                      <input type="button" class="button"  value="Grab deal" /></a>
                      <?php }
                  }
                  else{ 
                    if($value[store]=='Flipkart') {
                      ?>
                      <input type="button" class="button" id="btnclick" url="<?php echo $value[productUrl];?>" value="Grab deal" />
                  <?php }else{ ?>
                      <input type="button" class="button" id="btnclick" url="<?php echo $value[productUrl];?>" value="Grab deal" />
                  
                        <?php
                        }
                        ?>
                   <?php } ?>
                <img src="<?php echo get_template_directory_uri();?>/images/loading.gif" class="loading" id="loading_<?php echo $j++;?>" style="display:none">
                </div>

              </div>
              
              <?php } ?>
            </div>
        </div>
      </div><!-- #content -->
  </div><!-- #primary -->


 </div><!-- #main -->
    <footer id="colophon" class="site-footer" role="contentinfo">
      <div class="site-info">
        <a href="" title=""><?php printf( __( 'Copywrite', '' ), 'Aim2Excel' ); ?></a>
      </div>
    </footer>
  </div>

  <?php wp_footer(); ?>
</body>
</html>