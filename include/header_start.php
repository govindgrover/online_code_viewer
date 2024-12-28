<?php
	require_once(dirname(__DIR__) . "/ams/modules/functions.php");
	ob_start("grUtilityCompress");
	
	if (DEBUG)
		header("Cache-Control:no-cache, no-store");

	header("Content-Type: text/html; charset=utf-8"); 

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="./assets/css/all.min.css" />
		<link rel="stylesheet" href="./assets/css/main.css" />
		<title><?php echo getPageTitle(); ?></title>
