<?php
//amazon api

define('AWS_ACCESS_KEY_ID', 'AKIAJNU44DH42L7DNXSA');
define('AWS_SECRET_ACCESS_KEY', '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');
define('AMAZON_ASSOC_TAG', 'coucasind-21');

function amazon_get_signed_url1($searchTerm,$page) {
$base_url = "http://webservices.amazon.in/onca/xml";
$params = array(
'AWSAccessKeyId' => AWS_ACCESS_KEY_ID,
'AssociateTag' => AMAZON_ASSOC_TAG,
'Version' => "2015-06-14",
'Operation' => "ItemSearch",
'Service' => "AWSECommerceService",
'ResponseGroup' => "Large",
'Availability' => "Available",
'Condition' => "All",
'Operation' => "ItemSearch",
'SearchIndex' => 'All', 
'ItemPage'=>$page,
'Keywords' => $searchTerm);

//'ResponseGroup'=>"Images,ItemAttributes,EditorialReview",

if(empty($params['AssociateTag'])) {
unset($params['AssociateTag']);
}

// Add the Timestamp
$params['Timestamp'] = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());

// Sort the URL parameters
$url_parts = array();
foreach(array_keys($params) as $key)
$url_parts[] = $key . "=" . str_replace('%7E', '~', rawurlencode($params[$key]));
sort($url_parts);

// Construct the string to sign
$url_string = implode("&", $url_parts);
$string_to_sign = "GET\nwebservices.amazon.in\n/onca/xml\n" . $url_string;

// Sign the request
$signature = hash_hmac("sha256", $string_to_sign, AWS_SECRET_ACCESS_KEY, TRUE);

// Base64 encode the signature and make it URL safe
$signature = urlencode(base64_encode($signature));

$url = $base_url . '?' . $url_string . "&Signature=" . $signature;

return ($url);
}


?>