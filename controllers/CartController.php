<?php 

class CartController
{
	
	public function actionIndex()
	{
		$metaTitle = 'Your Cart';
		
		$categories = array();
		$categories = Category::getCategoriesList();
		
		$productsInCart = false;
		
		// get data from cart
		$productsInCart = Cart::getProducts();
		
		if($productsInCart) {
			// get full info about products
			$productsIds = array_keys($productsInCart);
			$products = Product::getProductsByIds($productsIds);
			
			// get total price
			$totalPrice = Cart::getTotalPrice($products);
		}
		
		require_once(ROOT . '/views/cart/index.php');
		
		return true;
	}
	
	public function actionAdd($id)
	{
		// Add product to the cart
		Cart::addProduct($id);
		
		// Return user to the page
		$referrer = $_SERVER['HTTP_REFERER'];
		header("Location: $referrer");
	}
	
	public function actionDelete($id)
    {
		// Delete product from the cart
		Cart::deleteProduct($id);
		
		// Return user to the cart
		header("Location: /cart/");
    }
	
	public function actionAddAjax($id)
	{
		// Add product to the cart
		echo Cart::addProduct($id);
		return true;
	}
	
	// checkout the order
	public function actionCheckout()
	{
		$metaTitle = 'Checkout the order';

        // Category list for the left menu
        $categories = array();
        $categories = Category::getCategoriesList();


        // checkout order status
        $result = false;


        // is form submitted?
        if (isset($_POST['submit'])) {
            // is form submitted? - yes
            // Read form data
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            // Validation
            $errors = false;
            if (!User::checkName($userName))
                $errors[] = 'Wrong name';
            if (!User::checkPhone($userPhone))
                $errors[] = 'Wrong phone';

            // is form filled correctly?
            if ($errors == false) {
                // is form filled correctly? - Yes
                // Save order to the db
                // Collect info about the order
                $productsInCart = Cart::getProducts();
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }

                // Save to the db
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {
                    // Mail to admin about new order               
                    $adminEmail = 'graywolf985@gmail.com';
                    $message = 'http://simple-store.loc/admin/orders';
                    $subject = 'New Order!';
					$from = 'noreply@simple-store.com';
					$headers = 'From: '.$from . "\r\n" .
						'Reply-To: ' . $from . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
                    mail($adminEmail, $subject, $message, $headers);

                    // Clear cart
                    Cart::clear();
                }
            } else {
                // is form filled correctly? - No
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }
        } else {
            // is form submitted? - No
            // get data from the cart
            $productsInCart = Cart::getProducts();

            // Are products in the cart?
            if ($productsInCart == false) {
                // Are products in the cart? - No
                // redirect to the homepage
                header("Location: /");
            } else {
                // Are products in the cart? - Yes
                // collect data
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();


                $userName = false;
                $userPhone = false;
                $userComment = false;

                // is user logged in?
                if (User::isGuest()) {
                    // No
                    // form is empty
                } else {
                    // Yes         
                    // Get user from db by id
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    // fill in the form
                    $userName = $user['name'];
                }
            }
        }

        require_once(ROOT . '/views/cart/checkout.php');

        return true;
	}
	
}