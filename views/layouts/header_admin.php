<?php 
	$showMetaTitle = isset($metaTitle) ? $metaTitle : 'Simple Store';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php echo $showMetaTitle; ?></title>
	
	<link rel="stylesheet" href="/template/bower_components/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/template/css/style.css" />
</head>

<body>
	<div class="wrap1200 admin-panel">
		<header class="main-header admin-header">
			<div class="mh-r">
				<a href="/"><i class="fa fa-sign-out"></i> To the site</a>
			</div>
			<a href="/admin"><i class="fa fa-edit"></i> Admin Panel</a>
		</header>