<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<div class="side-menu">
	<ul>
	<?php foreach ($categories as $categoryItem) { ?>
		<li class="<?php if($category == $categoryItem['slug']) echo 'active'; ?>"><a href="/catalog/<?php echo $categoryItem['slug']; ?>"><?php echo $categoryItem['name']; ?></a></li>
	<?php } ?>
	</ul>
</div>
<section class="main-cont mc-wl">

	<h2>Cart</h2>
	
	<?php if($result) { ?>
		<p>Order is processed. We will call you back.</p>
	<?php } else { ?>

		<p>Number of chosen products: <strong><?php echo $totalQuantity; ?></strong> / Total price: <strong><?php echo $totalPrice; ?> $</strong></p>
		
		<?php if(isset($errors) && is_array($errors)) { ?>
			<ul class="formerrors-list">
				<?php foreach($errors as $error) { ?>
					<li><?php echo $error; ?></li>
				<?php } ?>
			</ul>
		<?php } ?>

		<p>To make an order, please fill out the form. Our manager will contact you.</p>

		<div class="signup-form">
			<form action="" method="post">

				<label>Your name:</label>
				<input type="text" name="userName" placeholder="Name" value="<?php echo $userName; ?>" />

				<label>Phone number:</label>
				<input type="text" name="userPhone" placeholder="Phone" value="<?php echo $userPhone; ?>" maxlength="17" />

				<label>Comment:</label>
				<input type="text" name="userComment" placeholder="Сообщение" value="<?php echo $userComment; ?>" />

				<button type="submit" name="submit" class="btn btn-default">Checkout</button>
			</form>
		</div>
                        
	<?php } ?>
	
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>