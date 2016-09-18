<?php

class News
{

	// get single news item by id
	public static function getNewsItemById($id)
	{
		$id = intval($id);
		
		if($id) {
			$db = Db::getConnection();
		
			$result = $db->query('SELECT * FROM news WHERE id='.$id);
			
			$result->setFetchMode(PDO::FETCH_ASSOC);
			
			$newsItem = $result->fetch();
			
			$categoryArr = News::getCategoryNameById($newsItem['category_id']);
			$newsItem['categoryArr'] = $categoryArr;
		
			return $newsItem;
		}
	}
	
	// get news list
	public static function getNewsList()
	{
		$db = Db::getConnection();
		
		$newsList = array();
		
		$result = $db->query('SELECT id, title, slug, date, short_content, category_id FROM news ORDER BY date DESC LIMIT 10');
		
		$i = 0;
		while($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['slug'] = $row['slug'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			//$catRes = $db->query('SELECT slug FROM news_category WHERE `id`="'.$row['category_id'].'"');
			//$catResIt = $catRes->fetch();
			$categoryArr = News::getCategoryNameById($row['category_id']);
			$newsList[$i]['category_slug'] = $categoryArr['slug'];//$catResIt['slug'];
			$i++;
		}
		
		return $newsList;
	}
	
	public static function getNewsCategoryList($category)
	{
		$db = Db::getConnection();
		
		$newsList = array();
		
		$catRes = $db->query('SELECT * FROM news_category WHERE `slug`="'.$category.'"');
		
		$catRes->setFetchMode(PDO::FETCH_ASSOC);
		$categoryRow = $catRes->fetch();
		
		$result = $db->query('SELECT id, title, slug, date, short_content FROM news WHERE category_id="'.$categoryRow['id'].'" ORDER BY date DESC LIMIT 10');
		
		$i = 0;
		while($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['slug'] = $row['slug'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$newsList[$i]['category_slug'] = $category;
			$i++;
		}
		$newsCategResult = array('categoryInfo'=>$categoryRow, 'newsList'=>$newsList);
		
		return $newsCategResult;
	}
	
	private static function getCategoryNameById($category_id)
	{
		$db = Db::getConnection();
		$catRes = $db->query('SELECT title,slug FROM news_category WHERE `id`="'.$category_id.'"');
		$catResIt = $catRes->fetch();
		return $catResIt;
	}

}