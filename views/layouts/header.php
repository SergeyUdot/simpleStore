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
	<div class="wrap1200">
		<header class="main-header">
			<div class="mh-r">
				<a href="/cart">Cart (<span id="cart-count"><?php echo Cart::countItems(); ?></span>)</a>
				<?php if(User::isGuest()) { ?>
					<a href="/user/login/">Log in</a>
					<a href="/user/register/">Register</a>
				<?php } else { ?>
					<a href="/cabinet/">Account</a>
					<a href="/user/logout/">Log out</a>
				<?php } ?>
			</div>
			Test site
		</header>