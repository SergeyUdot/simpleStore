<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<section class="main-cont">
	
	<h1>Your Account</h1>
	
	<h3>Hello, <?php echo $user['name']; ?>!</h3>
	
	<table class="cart-table">
	  <tr>
	    <th colspan="2">Your personal data</th>
	  </tr>
	  <tr>
		<td>Name:</td><td><?php echo $user['name']; ?></td>
	  </tr>
	  <tr>
		<td>E-mail:</td><td><?php echo $user['email']; ?></td>
	  </tr>
	  <tr>
		<td>Phone number:</td><td><?php echo $user['phone']; ?></td>
	  </tr>
	  <tr>
		<td>Address:</td><td><?php echo $user['address']; ?></td>
	  </tr>
	</table>
	
	<ul class="account-menu">
		<li><a href="/cabinet/edit/">Edit your data</a></li>
		<li><a href="/cabinet/history/">Purchase history</a></li>
	</ul>
	
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>