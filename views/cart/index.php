<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<div class="side-menu">
	<ul>
	<?php foreach ($categories as $categoryItem) { ?>
		<li><a href="/catalog/<?php echo $categoryItem['slug']; ?>"><?php echo $categoryItem['name']; ?></a></li>
	<?php } ?>
	</ul>
</div>
<section class="main-cont mc-wl">
  
  <h2>Cart</h2>
  
  <?php if($productsInCart) { ?>
	<p>You added these products to the cart:</p>
	<table cellpadding="0" cellspacing="0" class="cart-table">
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Price, $</th>
			<th>Quantity</th>
			<th>Remove</th>
		</tr>
		<?php foreach($products as $product) { ?>
			<tr>
				<td><?php echo $product['code']; ?></td>
				<td>
					<a href="/catalog/<?php echo $product['category_slug']; ?>/<?php echo $product['slug'].'-'.$product['id']; ?>">
						<?php echo $product['name']; ?>
					</a>
				</td>
				<td><?php echo $product['price']; ?></td>
				<td><?php echo $productsInCart[$product['id']]; ?></td>
				<td class="ta-r"><a href="/cart/delete/<?php echo $product['id']; ?>" class="cart-remove-item"><i class="fa fa-times" aria-hidden="true"></i></a></td>
			</tr>
		<?php } ?>
		<tr>
			<td colspan="3"><strong>Total price:</strong></td>
			<td colspan="2" class="ta-r"><strong>$ <?php echo $totalPrice; ?></strong></td>
		</tr>
	</table>
	<a href="/cart/checkout" class="btn btn-checkout">Place an order</a>
  <?php } else { ?>
	<p>The cart is empty</p>
  <?php } ?>

</section>
<div class="c_b"></div>

<?php include ROOT.'/views/layouts/footer.php'; ?>