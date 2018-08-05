<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="main-cont">
    <br/>

    <div class="breadcrumbs">
        <ul class="breadcrumb">
            <li><a href="/admin">Admin Panel</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
            <li><a href="/admin/order">Order Management</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
            <li class="active">Delete Order</li>
        </ul>
    </div>


    <h4>Delete Order #<?php echo $id; ?></h4>


    <p>Are you sure that you want to remove this order?</p>

    <form method="post">
        <button type="submit" name="submit" class="btn btn-remove"><i class="fa fa-times"></i>Delete</button>
    </form>

</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>