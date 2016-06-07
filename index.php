<?php
error_reporting( E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED );
/** 
 * @author 		AmN
 */

require_once './config.php';

?>
<html>
<head>
<title>Image Rotator</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
	<div class="wrap">
		<div class="box">
			<form name="images" method="post" action="index.php">
				<h3>Image URLs</h3>
				<textarea name="images" class="images" placeholder="Enter one image url per line. MAX: <?= MAX_URLS ?>" value=<?= $_POST['images'] ?>></textarea>
				<input type="submit" value="Get Link" class="button" />
				<div class="author">Built By: <a href="skype:askamn786">AmN</a></div>
			</form>
		</div>
	</div>
</div>

<?php

if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$images = explode( PHP_EOL, $_POST['images'] );

	if( !empty( $images ) )
	{
		$i = 1;
		$id = md5( microtime() . time() );
		foreach( $images AS $image )
		{
			$extension = mb_substr( $image, -3, 3 );
			if( !in_array( $extension, array( 'png', 'jpg' ) ) )
			{
				$error = 'Some images were left out as only PNGs and JPGs are allowed.';
				continue;
			}

			$data = file_get_contents( $image );

			if( !is_dir( './uploads/'.$id ) )
			{
				mkdir( './uploads/'.$id );
			}

			file_put_contents( './uploads/' . $id . '/' . $i++ . '.' . $extension, $data );
		}

		if( empty( $error ) )
			$success = '<img src="'. SITE_URL . '/image.php?get=' . $id . '" class="finalImage" />URL: ' . SITE_URL . '/image.php?get=' . $id;
	}
	else
	{
		$error = 'Please enter some URL(s)';
	}
}

if( !empty( $error ) )
{
	echo '<div class="error"><div class="wrap">'.$error.'</div></div>';
}

if( !empty( $success ) )
{
	echo '<div class="success"><div class="wrap">'.$success.'</div></div>';
}
?>

</body>
</html>