<?php
/**
 * Controller AdminOrderController
 * Oreder Management for Admin Panel
 */
class AdminOrderController extends AdminBase
{
    /**
     * Action for page "Order Management"
     */
    public function actionIndex()
    {
        // check access
        self::checkAdmin();
        // Get order list
        $ordersList = Order::getOrdersList();
        // Add view file
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }
	
    /**
     * Action for page "Edit order"
     */
    public function actionUpdate($id)
    {
        // check access
        self::checkAdmin();
        // Get data of the current order
        $order = Order::getOrderById($id);
        // Handle form
        if (isset($_POST['submit'])) {
            // If form is submitted   
            // Get data from the form
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];
            // Save changes
            Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);
            // Redirect user to Order management page
            header("Location: /admin/order/view/$id");
        }
        // Add view file
        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }
	
    /**
     * Action for page "Order View"
     */
    public function actionView($id)
    {
        // check access
        self::checkAdmin();
        // Get data of the current order
        $order = Order::getOrderById($id);
        // Get array of id and quantity of products
        $productsQuantity = json_decode($order['products'], true);
        // Get array of product id
        $productsIds = array_keys($productsQuantity);
        // Get product list in the order
        $products = Product::getProdustsByIds($productsIds);
        // Add view file
        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }
	
    /**
     * Action for page "Delete Order"
     */
    public function actionDelete($id)
    {
        // check access
        self::checkAdmin();
        // Handle form
        if (isset($_POST['submit'])) {
            // If form is submitted
            // Delete Order
            Order::deleteOrderById($id);
            // Redirect user to Order management page
            header("Location: /admin/order");
        }
        // Add view file
        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }
}