<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';

class CatalogController
{
	public function actionIndex() 
	{
		$metaTitle = 'Catalog';
		
		$categories = array();
		$categories = Category::getCategoriesList();
		
		$latestProducts = array();
		$latestProducts = Product::getLatestProducts(12);
		
		require_once(ROOT.'/views/catalog/index.php');
		
		return true;
	}
	
	public function actionCategory($category)
	{
		if($category) {
			
			$categories = array();
			$categories = Category::getCategoriesList();
			
			$categoryProducts = array();
			$categoryProducts = Product::getProductsListByCategory($category);
			
			$metaTitle = isset($categoryProducts[0]['category_name']) ? $categoryProducts[0]['category_name'] : 'Products';
			
			require_once(ROOT.'/views/catalog/category.php');
			
		}
		
		return true;
	}
	
	
	public function actionView($category, $id) 
	{
		$categories = array();
		$categories = Category::getCategoriesList();
		
		if($id) {
			$idArr = explode('-', $id);
			$product = Product::getProductById(end($idArr));
			$metaTitle = $product['name'];
			
			require_once(ROOT.'/views/catalog/view.php');
		}
		return true;
	}
}