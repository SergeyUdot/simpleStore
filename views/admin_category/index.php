<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="main-cont">
            <br/>

            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li class="active">Category Management</li>
                </ul>
            </div>
			
			<a href="/admin/category/create" class="btn btn-default back"><i class="fa fa-plus"></i>Add Category</a>
            <br /><br />
            <h4>Category List</h4>

            <table class="table-bordered table-striped table cart-table">
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Order Number</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($categoriesList as $category): ?>
                    <tr>
                        <td><?php echo $category['id']; ?></td>
                        <td><a href="/catalog/<?php echo $category['slug']; ?>" target="_blank"><?php echo $category['name']; ?></a></td>
                        <td><?php echo $category['sort_order']; ?></td>
                        <td><?php echo Category::getStatusText($category['status']); ?></td>  
                        <td><a href="/admin/category/update/<?php echo $category['id']; ?>" title="Edit Category" class="cart-remove-item"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/category/delete/<?php echo $category['id']; ?>" title="Delete Category" class="cart-remove-item"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
			<a href="/admin/category/create" class="btn btn-default back"><i class="fa fa-plus"></i>Add Category</a>
			<br/><br/>

</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>