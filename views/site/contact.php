<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<section class="main-cont">
	
	<?php if($result) { ?>
		<p>The message was sent!</p>
	<?php } else { ?>
		<?php if(isset($errors) && is_array($errors)) { ?>
			<ul class="formerrors-list">
				<?php foreach($errors as $error) { ?>
					<li><?php echo $error; ?></li>
				<?php } ?>
			</ul>
		<?php } ?>
	
		<div class="signup-form">
			<h2>Feedback form</h2>
			<p>Send a message if you have some questions.</p>
			<form action="" method="post">
				<label>Your email</label>
				<input type="email" name="userEmail" placeholder="E-mail" value="<?php echo $userEmail; ?>" />
				<label>Your message</label>
				<textarea placeholder="Message" name="userText"><?php echo $userText; ?></textarea>
				<button type="submit" name="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	<?php } ?>
	
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>