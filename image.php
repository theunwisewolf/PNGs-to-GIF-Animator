<?php

require_once './includes/GIFEncoder.class.php';
require_once './config.php';

if( !isset( $_GET['get'] ) )
{
	die( 'Invalid Id.' );
}

$id = $_GET['get'];

if( !is_dir( './uploads/' . $id ) )
{
	die( 'Not found.' );
}

$files = scandir( './uploads/' . $id );
array_shift( $files );
array_shift( $files );

foreach( $files AS $file )
{
	// Open the first source image and add the text.
	$image = imagecreatefrompng( './uploads/' . $id . '/' . $file );

	ob_start();
	imagegif($image);
	$frames[] = ob_get_contents();
	$framed[] = ANIMATION_DELAY; // Delay in the animation.
	ob_end_clean();
}

error_reporting( E_ALL ^ E_NOTICE );
header ('Content-type:image/gif');
$gif = new GIFEncoder($frames,$framed,0,2,0,0,0,'bin');
echo $gif->GetAnimation();

?>