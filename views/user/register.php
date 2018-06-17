<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<section class="main-cont">
	
	<?php if($result) { ?>
		<p>You are registered!</p>
	<?php } else { ?>
		<?php if(isset($errors) && is_array($errors)) { ?>
			<ul class="formerrors-list">
				<?php foreach($errors as $error) { ?>
					<li><?php echo $error; ?></li>
				<?php } ?>
			</ul>
		<?php } ?>
	
		<div class="signup-form">
			<h2>User registration</h2>
			<form action="" method="post">
				<input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" />
				<input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>" />
				<input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" />
				<button type="submit" name="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	<?php } ?>
	
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>