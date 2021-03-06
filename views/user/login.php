<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<section class="main-cont">
	
		<?php if(isset($errors) && is_array($errors)) { ?>
			<ul class="formerrors-list">
				<?php foreach($errors as $error) { ?>
					<li><?php echo $error; ?></li>
				<?php } ?>
			</ul>
		<?php } ?>
	
		<div class="signup-form">
			<h2>Login</h2>
			<form action="" method="post">
				<input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>" />
				<input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" />
				<button type="submit" name="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>