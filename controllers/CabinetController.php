<?php

class CabinetController
{
	
	public function actionIndex()
	{
		$userId = User::checkLogged();
		
		$user = User::getUserById($userId);
		
		$metaTitle = 'Your Account';
		
		require_once(ROOT . '/views/cabinet/index.php');
		
		return true;
	}
	
	public function actionEdit()
	{
		$metaTitle = 'Edit your data';
		
		$userId = User::checkLogged();
		
		$user = User::getUserById($userId);
		
		$name = $user['name'];
		$email = $user['email'];
		$phone = $user['phone'];
		$address = $user['address'];
		$password = $user['password'];
		
		$result = false;
		
		if(isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$address = $_POST['address'];
			$password = $_POST['password'];
			
			$errors = false;
			
			if(!User::checkName($name)) {
				$errors[] = 'Name should be at least 2 symbols length';
			}
			if(!User::checkEmail($email)) {
				$errors[] = 'Wrong e-mail';
			}
			if(!User::checkPassword($password)) {
				$errors[] = 'Password should be at least 6 symbols length';
			}
			if($user['email']!=$email && User::checkEmailExists($email)) {
				$errors[] = 'This e-mail is already used';
			}
			
			if($errors == false) {
				// Edit User
				$result = User::edit($userId, $name, $email, $phone, $address, $password);
			}
		}
		
		require_once(ROOT . '/views/cabinet/edit.php');
		
		return true;
	}
	
	/**
	 * Purchase history for user account
	 * @return bool
	 */
	public function actionHistory()
	{
		$metaTitle = 'Your purchase history';
		
		$userId = User::checkLogged();
		
		$user = User::getUserById($userId);
		
		$ordersList = Order::getOrdersByUser($userId);
		
		$products = array();
		if(count($ordersList)>0) {
			foreach($ordersList as $order) {
				$productsQuantity = json_decode($order['products'], true);
				// Get array of product id
				$productsIds = array_keys($productsQuantity);
				$products[$order['id']] = Product::getProdustsByIds($productsIds);
				$productsQuantityArr[$order['id']] = $productsQuantity;
			}
		}	
		
		require_once(ROOT . '/views/cabinet/history.php');
		
		return true;
	}
}