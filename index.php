<?php
/*
Plugin Name: DigitalOcean Spaces addon for humanmade/S3-Uploads
Description: Enable and set S3_UPLOADS_BUCKET & S3_UPLOADS_REGION constants to point to your DigitalOcean space
Author: @k1sul1
Version: 1.0
*/

$bucket = S3_UPLOADS_BUCKET;
$region = S3_UPLOADS_REGION;

define( 
  'S3_UPLOADS_BUCKET_URL', 
  "https://$bucket.$region.digitaloceanspaces.com",
);

add_action('plugins_loaded', function() {
  add_filter('s3_uploads_s3_client_params', function ($params) {
    $region = S3_UPLOADS_REGION;
    $params['endpoint'] = "https://$region.digitaloceanspaces.com";
    $params['use_path_style_endpoint'] = true;
    $params['debug'] = defined('WP_DEBUG') && WP_DEBUG; 
    return $params;
  });
});