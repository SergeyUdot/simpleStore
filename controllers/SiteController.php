<?php

class SiteController 
{
	
	public function actionIndex() 
	{
		// meta title TODO: add more custom meta tags
		$metaTitle = 'Homepage';
		
		$categories = array();
		$categories = Category::getCategoriesList();
		
		$latestProducts = array();
		$latestProducts = Product::getLatestProducts(4);
		
		// products for slider of recommended
		$sliderProducts = array();
		$sliderProducts = Product::getRecommendedProducts();
		
		require_once(ROOT.'/views/site/index.php');
		
		return true;
	}
	
	public function actionContact()
	{
		$metaTitle = 'Contacts';
		
		$userEmail = '';
		$userText = '';
		$result = false;
		
		if(isset($_POST['submit'])) {
			$userEmail = $_POST['userEmail'];
			$userText = $_POST['userText'];
			
			$errors = false;
			
			// Validate email
			if(!User::checkEmail($userEmail)) {
				$errors[] = 'Wrong e-mail!';
			}
			
			if($errors == false) {
				$adminEmail = 'graywolf@meta.ua';
				$subject = 'Subject of the mail';
				$message = "Message: {$userText}. From {$userEmail}";
				$from = 'noreply@simple-store.com';
				$headers = 'From: '.$from . "\r\n" .
					'Reply-To: ' . $from . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
				$result = mail($adminEmail, $subject, $message, $headers);
				$result = true;
			}
		}
		
		require_once(ROOT . '/views/site/contact.php');
		
		return true;
	}
	
	public function actionAbout() 
	{
		$metaTitle = 'About us';
		
		require_once(ROOT . '/views/site/about.php');
		
		return true;
	}
}