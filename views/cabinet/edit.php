<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<section class="main-cont">

	<div class="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="/cabinet/">Your Account</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
            <li class="active">Edit user data</li>
        </ul>
    </div>
	
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
				<label>Name:</label>
				<input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" />
				<label>E-mail:</label>
				<input type="text" name="email" placeholder="E-mail" value="<?php echo $email; ?>" />
				<label>Password:</label>
				<input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" />
				<button type="submit" name="submit" class="btn btn-default">Save</button>
			</form>
		</div>
	<?php } ?>
	
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>