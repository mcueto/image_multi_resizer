<?php
require_once('vendor/autoload.php');
use nwtn\Respimg as Respimg;

$photos_list = file_get_contents('photos.json');
$settings_list = file_get_contents('settings.json');


$photos = json_decode($photos_list);
$settings = json_decode($settings_list);

function optimize($input_path, $output_width, $output_folder){
  global $photos, $settings;

  $input_file_info = pathinfo($input_path);

  // Set the wildcards to replace
  $WILDCARDS = [
    '%OUTPUT_WIDTH%'  => $output_width,
    '%FILENAME%'      => $input_file_info["filename"],
    '%FILE_EXTENSION%'=> $input_file_info["extension"],
  ];

  // Get the configured(with wildcards) filename and folder
  $OUTPUT_CONFIG = [
    'OUTPUT_FOLDER'   => $settings->{'output_folder'},
    'OUTPUT_FILENAME' => $settings->{'output_filename'},
  ];

  // Replace wildcards in $OUTPUT_CONFIG
  foreach ($WILDCARDS as $wildcard => $value) {
    $OUTPUT_CONFIG  = str_replace($wildcard, $value, $OUTPUT_CONFIG);
  }

  // Check if output folder exists
  $dir_exists   = is_dir($OUTPUT_CONFIG['OUTPUT_FOLDER']);

  if (!$dir_exists){
    $folder_created = mkdir($OUTPUT_CONFIG['OUTPUT_FOLDER'], 0755, true);
    $dir_exists     = true;
  }

  // Instantiate the image
  $image = new Respimg($input_path);

  // Optimize the image to the given width
  $image->smartResize($output_width, 0, false);

  // Create the new & optimized image file
  $image->writeImage($OUTPUT_CONFIG['OUTPUT_FOLDER'].$OUTPUT_CONFIG['OUTPUT_FILENAME']);
}

foreach ($photos as $photo) {
  foreach ($settings->{'transformations'} as $transformation) {
    optimize($photo->{'src'}, $transformation->{'width'}, $settings->{'output_folder'});
  }
}
?>
