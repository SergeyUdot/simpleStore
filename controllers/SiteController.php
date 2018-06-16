<?php

class SiteController 
{
	
	public function actionIndex() 
	{
		$metaTitle = 'Homepage';
		
		$categories = array();
		$categories = Category::getCategoriesList();
		
		$latestProducts = array();
		$latestProducts = Product::getLatestProducts(4);
		
		require_once(ROOT.'/views/site/index.php');
		
		return true;
	}
}