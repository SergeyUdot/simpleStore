<?php

class User
{
	public static function register($name, $email, $phone, $address, $password)
	{
		$db = Db::getConnection();
		
		$sql = 'INSERT INTO user (name, email, phone, address, password) '
		     . 'VALUES (:name, :email, :phone, :address, :password)';
			 
		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->bindParam(':phone', $phone, PDO::PARAM_STR);
		$result->bindParam(':address', $address, PDO::PARAM_STR);
		
		return $result->execute();
	}
	
	/** 
	 * Edit user data
	 * @param string $name
	 * @param string $password
	 */
	public static function edit($id, $name, $email, $phone, $address, $password)
	{
		$db = Db::getConnection();
		
		$sql = 'UPDATE user SET name = :name, email = :email, phone = :phone, address = :address, password = :password WHERE id = :id';
		
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':phone', $phone, PDO::PARAM_STR);
		$result->bindParam(':address', $address, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		
		return $result->execute();
	}
	
	public static function checkName($name) {
		if (strlen($name) >= 2) {
			return true;
		}
		return false;
	}
	
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }
	
	public static function checkPassword($password) {
		if(strlen($password) >= 6) {
			return true;
		}
		return false;
	}
	
	public static function checkEmail($email) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}
	
	public static function checkEmailExists($email) {
		
		$db = Db::getConnection();
		
		$sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
		
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();
		
		if($result->fetchColumn()) {
			return true;
		}
		return false;
	}
	
	// Check if user with given email and password exists
	public static function checkUserData($email, $password)
	{
		$db = Db::getConnection();
		
		$sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
		
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();
		
		$user = $result->fetch();
		if($user) {
			return $user['id'];
		}
		
		return false;
	}
	
	// Remember logged-in user
	public static function auth($userId)
	{
		$_SESSION['user'] = $userId;
	}
	
	public static function checkLogged() 
	{
		if(isset($_SESSION['user'])) {
			return $_SESSION['user'];
		}
		
		header("Location: /user/login/");
	}
	
	// isGuest = true means that user is not authorized
	public static function isGuest()
	{
		if(isset($_SESSION['user'])) {
			return false;
		}
		return true;
	}
	
	/**
	 * Returns user by id
	 * @param integer $id
	 */
	public static function getUserById($id)
	{
		if($id) {
			$db = Db::getConnection();
			$sql = 'SELECT * FROM user WHERE id = :id';
			
			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
			// get data as array
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$result->execute();
			
			return $result->fetch();
		}
	}
}