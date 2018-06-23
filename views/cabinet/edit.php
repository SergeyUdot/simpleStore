<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<section class="main-cont">
	
	<?php if($result) { ?>
		<p>Your data was edited!</p>
	<?php } else { ?>
		<?php if(isset($errors) && is_array($errors)) { ?>
			<ul class="formerrors-list">
				<?php foreach($errors as $error) { ?>
					<li><?php echo $error; ?></li>
				<?php } ?>
			</ul>
		<?php } ?>
	
		<div class="signup-form">
			<h2>Edit user data</h2>
			<form action="" method="post">
				<label>Name:</label><br/>
				<input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" />
				<label>Password:</label><br/>
				<input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" />
				<button type="submit" name="submit" class="btn btn-default">Save</button>
			</form>
		</div>
	<?php } ?>
	
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>