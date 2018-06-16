<?php

class NewsController
{
	public function actionIndex() 
	{
		$newsList = array();
		$newsList = News::getNewsList();
		
		$metaTitle = 'News';
		
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
			
			$metaTitle = isset($categoryInfo['title']) ? $categoryInfo['title'] : 'News';
			
			require_once(ROOT.'/views/news/index.php');
			
		}
		
		return true;
	}
	
	public function actionView($category, $id) 
	{
		if($id) {
			$idArr = explode('-', $id);
			$newsItem = News::getNewsItemById(end($idArr));
			
			$metaTitle = $newsItem['title'];
			
			require_once(ROOT.'/views/news/view.php');
		}
		return true;
	}
	
}