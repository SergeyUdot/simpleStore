<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="main-cont">
            <br/>

            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li class="active">Order Management</li>
                </ul>
            </div>

            <br /><br />
            <h4>Order List</h4>

            <table class="table-bordered table-striped table cart-table">
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>User Phone</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($ordersList as $order) { ?>
                    <tr>
                        <td>
                            <a href="/admin/order/view/<?php echo $order['id']; ?>">
                                <?php echo $order['id']; ?>
                            </a>
                        </td>
                        <td><?php echo $order['user_name']; ?></td>
                        <td><?php echo $order['user_phone']; ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo Order::getStatusText($order['status']); ?></td>    
                        <td><a href="/admin/order/view/<?php echo $order['id']; ?>" title="Order view" class="cart-remove-item"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/order/update/<?php echo $order['id']; ?>" title="Edit order" class="cart-remove-item"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/order/delete/<?php echo $order['id']; ?>" title="Delete order" class="cart-remove-item"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php } ?>
            </table>
			<br/><br/>

</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>