<?php
/**
 * Controller AdminCategoryController
 * Product Categories management for admin panel
 */
class AdminCategoryController extends AdminBase
{
    /**
     * Action for page "Categories Management"
     */
    public function actionIndex()
    {
        // check access
        self::checkAdmin();
        // get category list
        $categoriesList = Category::getCategoriesListAdmin();
        // add view file
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }
	
    /**
     * Action for page "Add Category"
     */
    public function actionCreate()
    {
        // check access
        self::checkAdmin();
        // handle form
        if (isset($_POST['submit'])) {
            // if form is submitted
            // get form data
            $name = $_POST['name'];
			$slug = $_POST['slug'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
			$description = $_POST['description'];
            // errors status
            $errors = false;
            // Validation
            if (!isset($name) || empty($name)) {
                $errors[] = 'Fill in the fields';
            }
            if ($errors == false) {
                // if no errors
                // add new category
                Category::createCategory($name, $slug, $sortOrder, $status, $description);
                // redirect to /admin/category
                header("Location: /admin/category");
            }
        }
        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }
	
    /**
     * Action for page "Edit Category"
     */
    public function actionUpdate($id)
    {
        // check access
        self::checkAdmin();
        // get the data for the current category
        $category = Category::getCategoryById($id);
        // handle form
        if (isset($_POST['submit'])) {
            // if form is submitted
            // get form data
            $name = $_POST['name'];
			$slug = $_POST['slug'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
			$description = $_POST['description'];
            // Save changes
            Category::updateCategoryById($id, $name, $slug, $sortOrder, $status, $description);
            // redirect to /admin/category
            header("Location: /admin/category");
        }
        // get view
        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }
	
    /**
     * Action for page "Delete Category"
     */
    public function actionDelete($id)
    {
        // check access
        self::checkAdmin();
        // handle form
        if (isset($_POST['submit'])) {
            // if form is submitted
            // Delete category
            Category::deleteCategoryById($id);
            // redirect to /admin/category
            header("Location: /admin/category");
        }
        // get view
        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }
}