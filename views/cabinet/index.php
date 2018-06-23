<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<section class="main-cont">
	
	<h1>Your Account</h1>
	
	<h3>Hello, <?php echo $user['name']; ?>!</h3>
	
	<ul class="account-menu">
		<li><a href="/cabinet/edit/">Edit your data</a></li>
		<li><a href="/cabinet/history/">Purchase history</a></li>
	</ul>
	
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>