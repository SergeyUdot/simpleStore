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
	
	public function actionAddAjax($id)
	{
		// Add product to the cart
		echo Cart::addProduct($id);
		return true;
	}
}