<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="main-cont">

            <br/>

            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li><a href="/admin/product">Product Management</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li class="active">Edit Product</li>
                </ul>
            </div>


            <h4>Edit product #<?php echo $id; ?></h4>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul class="formerrors-list">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
 
                <div class="signup-form">
                    <form action="" method="post" enctype="multipart/form-data">

                        <label>Product Name</label>
                        <input type="text" name="name" placeholder="" value="<?php echo $product['name']; ?>" />
						
						<label>Product URL Name (slug)</label>
                        <input type="text" name="slug" placeholder="" value="<?php echo $product['slug']; ?>" />

                        <label>Vendor Code</label>
                        <input type="text" name="code" placeholder="" value="<?php echo $product['code']; ?>" />

                        <label>Price, $</label>
                        <input type="text" name="price" placeholder="" value="<?php echo $product['price']; ?>" />
						
						<label>Old Price, $</label>
                        <input type="text" name="old_price" placeholder="" value="<?php echo $product['old_price']; ?>" />

                        <label>Category</label>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" 
                                        <?php if ($product['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <label>Brand Name</label>
                        <input type="text" name="brand" placeholder="" value="<?php echo $product['brand']; ?>" />

                        <label>Product Photo</label>
						<img src="<?php echo Product::getImage($product['id']); ?>" width="150" alt="Current Product Image" class="admin-prod-img" />
                        <input type="file" name="image" placeholder="" value="<?php echo $product['image']; ?>" />

                        <label>Product Description</label>
                        <textarea name="description"><?php echo $product['description']; ?></textarea>

                        <label>Availability</label>
                        <select name="availability">
                            <option value="1" <?php if ($product['availability'] == 1) echo ' selected="selected"'; ?>>Yes</option>
                            <option value="0" <?php if ($product['availability'] == 0) echo ' selected="selected"'; ?>>No</option>
                        </select>

                        <label>New!</label>
                        <select name="is_new">
                            <option value="1" <?php if ($product['is_new'] == 1) echo ' selected="selected"'; ?>>Yes</option>
                            <option value="0" <?php if ($product['is_new'] == 0) echo ' selected="selected"'; ?>>No</option>
                        </select>

                        <label>Recommended</label>
                        <select name="is_recommended">
                            <option value="1" <?php if ($product['is_recommended'] == 1) echo ' selected="selected"'; ?>>Yes</option>
                            <option value="0" <?php if ($product['is_recommended'] == 0) echo ' selected="selected"'; ?>>No</option>
                        </select>
						
						<label>Promoted</label>
                        <select name="is_promo">
                            <option value="1" <?php if ($product['is_promo'] == 1) echo ' selected="selected"'; ?>>Yes</option>
                            <option value="0" <?php if ($product['is_promo'] == 0) echo ' selected="selected"'; ?>>No</option>
                        </select>

                        <label>Status (show/hide)</label>
                        <select name="status">
                            <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Show</option>
                            <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Hide</option>
                        </select>

                        <button type="submit" name="submit" class="btn btn-default">Save product</button>


                    </form>
                </div>
            

</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>