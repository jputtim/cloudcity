<?php 

session_start();

function dd($in, $dump = false)
{
	if ($dump) {
		var_dump($in);
		exit;
	}

	echo '<pre>';
	print_r($in);
	echo '</pre>';

	exit;
}

require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php';