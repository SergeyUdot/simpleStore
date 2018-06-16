<?php

class Category 
{
	/**
	 * Returns an Array of Categories
	 */
	public static function getCategoriesList()
	{
		$db = Db::getConnection();
		
		$categoryList = array();
		
		$result = $db->query('SELECT id, name, slug, description FROM product_category ORDER BY sort_order ASC');
		
		$i = 0;
		while($row = $result->fetch()) {
			$categoryList[$i]['id'] = $row['id'];
			$categoryList[$i]['name'] = $row['name'];
			$categoryList[$i]['slug'] = $row['slug'];
			$categoryList[$i]['description'] = $row['description'];
			$i++;
		}
		
		return $categoryList;
	}
}