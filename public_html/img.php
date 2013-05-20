<?php
// arquivo
$filename = $_GET['arquivo'];


//$filename = './arquivos/agenda/a285413b9d58db8da464aa4af1cbc9bf.png';
// $_GET['dim'] = '50x50';
// Dimensão
$dim = explode('x', $_GET['dim']);
$width = $dim['0'];
$height = $dim['1'];

// Extensão da imagem
	$caminho = explode('/', $filename);
	$abrir = $caminho[count($caminho)-1];
	$extencao = explode('.', $abrir);	

// Get new dimensions
list($width_orig, $height_orig) = getimagesize($filename);

$ratio_orig = $width_orig/$height_orig;

// Resample
$image_p = imagecreatetruecolor($width, $height);


switch($extencao['1']){
	case 'png':
		header('Content-type: image/png');
		$image = imagecreatefrompng($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		// Output
		imagepng($image_p);
		break;


	case 'jpg' || 'jpeg':
		header('Content-type: image/jpeg');
		$image = imagecreatefromjpeg($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		// Output
		imagejpeg($image_p, null, 100);
		break;

	case 'gif':
		header('Content-type: image/gif');
		$image = imagecreatefromgif($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		// Output
		imagegif($image_p);
		break;
		
}
?>
