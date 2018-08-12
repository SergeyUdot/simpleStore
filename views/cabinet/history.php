<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<section class="main-cont">

	<div class="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="/cabinet/">Your Account</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
            <li class="active">Purchase history</li>
        </ul>
    </div>
	
	<h1>Your Purchase history</h1>
	
	<?php if(count($ordersList)>0) { ?>
		<table class="table-bordered table-striped table cart-table">
			<tr>
				<th>#</th>
				<th>Order Date</th>
				<th>Status</th>
				<th>Products</th> 
			</tr>
			<?php foreach ($ordersList as $key => $order) { ?>
				<tr>
					<td><?php echo $key+1; ?></td>
					<td><?php echo $order['date']; ?></td>
					<td><?php echo Order::getStatusText($order['status']); ?></td>    
					<td>
						<table class="table-inner-prod" width="100%">
							<tr>
								<th>Vendor Code</th>
								<th>Name</th>
								<th>Price</th>
								<th>Quantity</th>
							</tr>
						<?php $oneOrderProducts = $products[$order['id']]; 
						$totalPrice = 0;
						$totalQuantity = 0;
						foreach ($oneOrderProducts as $product) { 
						?>
							<tr>
								<td><?php echo $product['code']; ?></td>
								<td><a href="/catalog/<?php echo $product['category_slug']; ?>/<?php echo $product['slug'].'-'.$product['id']; ?>" title="<?php echo $product['name']; ?>" target="_blank"><?php echo $product['name']; ?></a></td>
								<td>$<?php echo $product['price']; ?></td>
								<td><?php echo $productsQuantityArr[$order['id']][$product['id']]; ?></td>
							</tr>
						<?php
							$totalPrice = $totalPrice + $product['price'];
							$totalQuantity = $totalQuantity + $productsQuantityArr[$order['id']][$product['id']];
						}					
						?>
							<tr>
								<td colspan="2"><b>Total</b></td>
								<td>$<?php echo number_format((float)$totalPrice, 2, '.', ''); ?></td>
								<td><?php echo $totalQuantity; ?></td>
							</tr>
						</table>
					</td>
				</tr>
			<?php } ?>
		</table>
	<?php } else { ?>
	 <p>Your purchase history is empty.</p>
	<?php } ?>
	<br/><br/>
	
</section>

<?php include ROOT.'/views/layouts/footer.php'; ?>