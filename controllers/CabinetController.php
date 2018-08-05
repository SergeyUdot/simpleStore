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
		$password = $user['password'];
		
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
			if($user['email']!=$email && User::checkEmailExists($email)) {
				$errors[] = 'This e-mail is already used';
			}
			
			if($errors == false) {
				// Edit User
				$result = User::edit($userId, $name, $email, $password);
			}
		}
		
		require_once(ROOT . '/views/cabinet/edit.php');
		
		return true;
	}
}