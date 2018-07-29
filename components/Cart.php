<?php 

class Cart
{
	
	public static function addProduct($id)
	{
		$id = intval($id);
		
		// Empty array for products in the cart
		$productsInCart = array();
		
		// if cart has some prod-s
		if(isset($_SESSION['products'])) {
			$productsInCart = $_SESSION['products'];
		}
		
		if(array_key_exists($id, $productsInCart)) {
			// if the product is already in the cart -> increase quantity
			$productsInCart[$id]++;
		} else {
			// add new product to the cart
			$productsInCart[$id] = 1;
		}
		
		$_SESSION['products'] = $productsInCart;
		
		return self::countItems();
	}
	
	public static function deleteProduct($id)
	{
		$id = intval($id);
		
		// Products in the cart
		$productsInCart = self::getProducts();
		
		if(array_key_exists($id, $productsInCart)) {
			// if the product is already in the cart -> decrease quantity
			if($productsInCart[$id]>1) {
				$productsInCart[$id]--;
			} else {
				// or delete it 
				unset($productsInCart[$id]);
			}
		}
		
		$_SESSION['products'] = $productsInCart;
		
		return self::countItems();
	}
	
	/**
	 * Count number of products in the session
	 * @return int
	 */
	public static function countItems()
	{
		if(isset($_SESSION['products'])) {
			$count = 0;
			foreach($_SESSION['products'] as $id => $quantity) {
				$count = $count + $quantity;
			}
			return $count;
		} else {
			return 0;
		}
	}
	
	public static function getProducts()
	{
		if(isset($_SESSION['products'])) {
			return $_SESSION['products'];
		}
		return false;
	}
	
	public static function getTotalPrice($products)
	{
		$productsInCart = self::getProducts();
		
		$total = 0;
		if($productsInCart) {
			foreach($products as $item) {
				$total += $item['price'] * $productsInCart[$item['id']];
			}
		}
		
		return $total;
	}
	
	public static function clear()
	{
		if(isset($_SESSION['products'])) {
			unset($_SESSION['products']);
		}
	}
}