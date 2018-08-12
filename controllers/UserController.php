<?php 

class UserController
{
	
	public function actionRegister()
	{
		$metaTitle = 'Register User';
		
		$name = '';
		$email = '';
		$password = '';
		$phone = '';
		$address = '';
		$result = false;
		
		if(isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$phone = $_POST['phone'];
			$address = $_POST['address'];
			
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
			if(User::checkEmailExists($email)) {
				$errors[] = 'This e-mail is already used';
			}
			
			if($errors == false) {
				// Save User
				$result = User::register($name, $email, $phone, $address, $password);
			}
		}
		
		require_once(ROOT . '/views/user/register.php');
		
		return true;
	}
	
	public function actionLogin()
	{
		$metaTitle = 'Login User';
		
		$email = '';
		$password = '';
		
		if(isset($_POST['submit'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			$errors = false;
			
			// Validation
			if(!User::checkEmail($email)) {
				$errors[] = 'Wrong e-mail';
			}
			if(!User::checkPassword($password)) {
				$errors[] = 'Password should be at least 6 symbols length';
			}
			
			// Check if user exists
			$userId = User::checkUserData($email, $password);
			
			if($userId == false) {
				$errors[] = 'Wrong data to log in this site';
			} else {
				User::auth($userId);
				
				// redirect to cabinet
				header("Location: /cabinet/");
			}
		}
		
		require_once(ROOT . '/views/user/login.php');
		
		return true;
	}
	
	// Remove user from session
	public function actionLogout()
	{
		unset($_SESSION['user']);
		header("Location: /");
	}
}