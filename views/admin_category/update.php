<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="main-cont">

            <br/>

            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li><a href="/admin/category">Category Management</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li class="active">Edit category</li>
                </ul>
            </div>


            <h4>Edit category "<?php echo $category['name']; ?>"</h4>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul class="formerrors-list">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
 
                <div class="signup-form">
                    <form action="" method="post" enctype="multipart/form-data">

                        <label>Category Name</label>
                        <input type="text" name="name" placeholder="" value="<?php echo $category['name']; ?>" />
						
						<label>Category URL Name (slug)</label>
                        <input type="text" name="slug" placeholder="" value="<?php echo $category['slug']; ?>" />

                        <label>Sort Order</label>
                        <input type="text" name="sort_order" placeholder="" value="<?php echo $category['sort_order']; ?>" />

                        <p>Status (show/hide)</p>
                        <select name="status">
                            <option value="1" <?php if ($category['status'] == 1) echo ' selected="selected"'; ?>>Shown (active)</option>
                            <option value="0" <?php if ($category['status'] == 0) echo ' selected="selected"'; ?>>Hidden (not active)</option>
                        </select>
						
						<label>Description</label>
                        <textarea name="description" placeholder=""><?php echo $category['description']; ?></textarea>

                        <button type="submit" name="submit" class="btn btn-default">Save category</button>

                    </form>
                </div>
            

</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>