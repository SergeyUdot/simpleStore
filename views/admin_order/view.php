<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="main-cont">
            <br/>

            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
					<li><a href="/admin/order">Order Management</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li class="active">Order View</li>
                </ul>
            </div>

            <br /><br />
            <h4>Order #<?php echo $order['id']; ?>  <a href="/admin/order/update/<?php echo $order['id']; ?>" title="Edit current order" class="edit-item"><i class="fa fa-pencil-square-o"></i></a></h4>
			
			<h5>Order Info</h5>
            <table class="table-bordered table-striped table cart-table">
                <tr>
                    <td>Order ID</td>
                    <td><?php echo $order['id']; ?></td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td><?php echo $order['user_name']; ?></td>
                </tr>
                <tr>
                    <td>User Phone</td>
                    <td><?php echo $order['user_phone']; ?></td>
                </tr>
                <tr>
                    <td>User Comment</td>
                    <td><?php echo $order['user_comment']; ?></td>
                </tr>
                <?php if ($order['user_id'] != 0): ?>
                    <tr>
                        <td>User ID</td>
                        <td><?php echo $order['user_id']; ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><b>Order Status</b></td>
                    <td><?php echo Order::getStatusText($order['status']); ?></td>
                </tr>
                <tr>
                    <td><b>Order Date</b></td>
                    <td><?php echo $order['date']; ?></td>
                </tr>
            </table>
			<br/>
			
			<h5>Products in the current order</h5>

            <table class="table-bordered table-striped table cart-table">
                <tr>
                    <th>Product ID</th>
                    <th>Vendor Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <?php 
				$totalPrice = 0;
				$totalQuantity = 0;
				foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['code']; ?></td>
                        <td><a href="/catalog/<?php echo $product['category_slug']; ?>/<?php echo $product['slug'].'-'.$product['id']; ?>" title="<?php echo $product['name']; ?>" target="_blank"><?php echo $product['name']; ?></a></td>
                        <td>$<?php echo $product['price']; ?></td>
                        <td><?php echo $productsQuantity[$product['id']]; ?></td>
                    </tr>
                <?php 
				$totalPrice = $totalPrice + $product['price'];
				$totalQuantity = $totalQuantity + $productsQuantity[$product['id']];
				} ?>
				<tr>
					<td colspan="3">Total</td>
					<td>$<?php echo number_format((float)$totalPrice, 2, '.', ''); ?></td>
					<td><?php echo $totalQuantity; ?></td>
				</tr>
            </table>

            <a href="/admin/order/" class="btn btn-default back"><i class="fa fa-arrow-left"></i>Back</a>

			<br/><br/>

</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>