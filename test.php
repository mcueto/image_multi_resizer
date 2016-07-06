<?php
require_once('vendor/autoload.php');
use nwtn\Respimg as Respimg;

function optimize($photo, $width, $output_folder){
  $input_filename = $photo;
  $output_filename = basename($photo);
  $output_width = $width;

  $output_folder = "$output_folder"."/"."$width";

  $dir_exists = is_dir($output_folder);

  if (!$dir_exists){
    $folder_created = mkdir($output_folder, 0755, true);
    $dir_exists = true;
  }

  $image = new Respimg($input_filename);
  $image->smartResize($output_width, 0, false);
  $image->writeImage($output_folder."/".$output_filename);
}

$photos_list = file_get_contents('photos.json');
$settings_list = file_get_contents('settings.json');

$photos = json_decode($photos_list);
$settings = json_decode($settings_list);

foreach ($photos as $photo) {
  foreach ($settings->{'transformations'} as $transformation) {
    optimize($photo->{'src'}, $transformation->{'width'}, $settings->{'output_folder'});
  }
}
?>
