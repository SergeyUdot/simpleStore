<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section class="main-cont">

            <br/>

            <div class="breadcrumbs">
                <ul class="breadcrumb">
                    <li><a href="/admin">Admin Panel</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li><a href="/admin/product">Product Management</a><i class="fa fa-arrow-right" aria-hidden="true"></i></li>
                    <li class="active">Add new product</li>
                </ul>
            </div>


            <h4>Add new product</h4>

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
                        <input type="text" name="name" placeholder="" value="" />
						
						<label>Product URL Name (slug)</label>
                        <input type="text" name="slug" placeholder="" value="" />

                        <label>Vendor Code</label>
                        <input type="text" name="code" placeholder="" value="" />

                        <label>Price, $</label>
                        <input type="text" name="price" placeholder="" value="" />
						
						<label>Old Price, $</label>
                        <input type="text" name="old_price" placeholder="" value="" />

                        <label>Category</label>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select> 

                        <label>Brand Name</label>
                        <input type="text" name="brand" placeholder="" value="" />

                        <label>Product Photo</label>
                        <input type="file" name="image" placeholder="" value="" />

                        <label>Product Description</label>
                        <textarea name="description"></textarea>

                        <label>Availability</label>
                        <select name="availability">
                            <option value="1" selected="selected">Yes</option>
                            <option value="0">No</option>
                        </select>

                        <label>New!</label>
                        <select name="is_new">
                            <option value="1">Yes</option>
                            <option value="0" selected="selected">No</option>
                        </select>

                        <label>Recommended</label>
                        <select name="is_recommended">
                            <option value="1">Yes</option>
                            <option value="0" selected="selected">No</option>
                        </select>
						
						<label>Promoted</label>
                        <select name="is_promo">
                            <option value="1">Yes</option>
                            <option value="0" selected="selected">No</option>
                        </select>

                        <label>Status (show/hide)</label>
                        <select name="status">
                            <option value="1" selected="selected">Show</option>
                            <option value="0">Hide</option>
                        </select>

                        <button type="submit" name="submit" class="btn btn-default">Save product</button>


                    </form>
                </div>
            

</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>