<?php
/**
 * Controller AdminProductController
 * Product Management in Admin Panel
 */
class AdminProductController extends AdminBase
{
    /**
     * Action for page "Product Management"
     */
    public function actionIndex()
    {
        // Check access
        self::checkAdmin();
        // Get product list
        $productsList = Product::getProductsList();
        // add view file
        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }
	
    /**
     * Action for page "Add Product"
     */
    public function actionCreate()
    {
        // Check access
        self::checkAdmin();
        // Get categories list
        $categoriesList = Category::getCategoriesListAdmin();
        // Handle Form
        if (isset($_POST['submit'])) {
            // If form is submitted
            // get form data
            $options['name'] = $_POST['name'];
			$options['slug'] = $_POST['slug'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
			$options['old_price'] = $_POST['old_price'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
			$options['is_promo'] = $_POST['is_promo'];
            $options['status'] = $_POST['status'];
            // errors status
            $errors = false;
            // Validation TODO: make more validation
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Fill in the fields';
            }
            if ($errors == false) {
                // if no errors
                // Add new product
                $id = Product::createProduct($options);
                // if prod is added
                if ($id) {
                    // check if image was loaded
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // if loaded then move it to the right folder and rename
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                };
                // Move user to product page
                header("Location: /admin/product");
            }
        }
        // add view file
        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }
	
    /**
     * Action for page "Edit Product"
     */
    public function actionUpdate($id)
    {
        // Check access
        self::checkAdmin();
        // Get categories list
        $categoriesList = Category::getCategoriesListAdmin();
        // Get current product
        $product = Product::getProductById($id);
        // Handle form
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Get data for the form
            $options['name'] = $_POST['name'];
			$options['slug'] = $_POST['slug'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
			$options['old_price'] = $_POST['old_price'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
			$options['is_promo'] = $_POST['is_promo'];
            $options['status'] = $_POST['status'];
            // Save changes
            if (Product::updateProductById($id, $options)) {
                // If prod is saved
                // check if image was loaded
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    // if loaded then move it to the right folder and rename
                   move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                }
            }
            // Move user to product page
            header("Location: /admin/product");
        }
        // add view file
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }
	
    /**
     * Action for page "Delete Product"
     */
    public function actionDelete($id)
    {
        // Check access
        self::checkAdmin();
        // Handle form
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Delete Product
            Product::deleteProductById($id);
            // Move user to product page
            header("Location: /admin/product");
        }
        // add view file
        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }
}
