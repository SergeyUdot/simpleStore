<?php 

class UserController
{
	
	public function actionRegister()
	{
		$metaTitle = 'Register User';
		
		$name = '';
		$email = '';
		$password = '';
		$result = false;
		
		if(isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
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
			if(User::checkEmailExists($email)) {
				$errors[] = 'This e-mail is already used';
			}
			
			if($errors == false) {
				// Save User
				$result = User::register($name, $email, $password);
			}
		}
		
		require_once(ROOT . '/views/user/register.php');
		
		return true;
	}
}