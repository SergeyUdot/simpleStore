<?php

include_once ROOT.'/models/News.php';

class NewsController
{
	public function actionIndex() 
	{
		$newsList = array();
		$newsList = News::getNewsList();
		
		require_once(ROOT.'/views/news/index.php');
		
		return true;
	}
	
	public function actionCategory($category)
	{
		if($category) {
			//echo $category;
			
			$newsList = array();
			$newsCategoryResult = News::getNewsCategoryList($category);
			$newsList = $newsCategoryResult['newsList'];
			$categoryInfo = $newsCategoryResult['categoryInfo'];
			
			require_once(ROOT.'/views/news/index.php');
			
		}
		
		return true;
	}
	
	public function actionView($category, $id) 
	{
		if($id) {
			$idArr = explode('-', $id);
			$newsItem = News::getNewsItemById(end($idArr));
			
			require_once(ROOT.'/views/news/view.php');
		}
		return true;
	}
	
}