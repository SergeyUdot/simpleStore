<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="main-cont">
            <br/>

            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li class="active">Product Management</li>
                </ul>
            </div>

            <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i>Add Product</a>
            <br /><br />
            <h4>Product List</h4>

            <table class="table-bordered table-striped table cart-table">
                <tr>
                    <th>Product ID</th>
                    <th>Vendor Code</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($productsList as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['code']; ?></td>
                        <td><a href="/catalog/<?php echo $product['category_slug']; ?>/<?php echo $product['slug'].'-'.$product['id']; ?>" title="<?php echo $product['name']; ?>" target="_blank"><?php echo $product['name']; ?></a></td>
                        <td><?php echo $product['price']; ?></td>  
                        <td><a href="/admin/product/update/<?php echo $product['id']; ?>" title="Edit Product" class="cart-remove-item"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/product/delete/<?php echo $product['id']; ?>" title="Delete Product" class="cart-remove-item"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
			
			<a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i>Add Product</a>
			<br/><br/>

</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>