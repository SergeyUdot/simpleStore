<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="main-cont">

            <br/>

            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li><a href="/admin/order">Order Management</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li class="active">Edit Order</li>
                </ul>
            </div>


            <h4>Edit order #<?php echo $id; ?></h4>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul class="formerrors-list">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
 
                <div class="signup-form">
                    <form action="" method="post">
                        <label>User Name</label>
                        <input type="text" name="userName" placeholder="" value="<?php echo $order['user_name']; ?>">

                        <label>User Phone</label>
                        <input type="text" name="userPhone" placeholder="" value="<?php echo $order['user_phone']; ?>">

                        <label>User Comment</label>
                        <input type="text" name="userComment" placeholder="" value="<?php echo $order['user_comment']; ?>">

                        <label>Order date</label>
                        <input type="text" name="date" placeholder="" value="<?php echo $order['date']; ?>">

                        <label>Status</label>
                        <select name="status">
                            <option value="1" <?php if ($order['status'] == 1) echo ' selected="selected"'; ?>>New order</option>
                            <option value="2" <?php if ($order['status'] == 2) echo ' selected="selected"'; ?>>In processing</option>
                            <option value="3" <?php if ($order['status'] == 3) echo ' selected="selected"'; ?>>In delivery</option>
                            <option value="4" <?php if ($order['status'] == 4) echo ' selected="selected"'; ?>>Done</option>
                        </select>
                        <br>
						<button type="submit" name="submit" class="btn btn-default">Save Order</button>
                    </form>
                </div>
            <br/>

</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>