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
	
	/**
     * Returns an array of prod categories for Admin Panel <br/>
     * (shows both - turned on and off)
     * @return array <p>Array of categories</p>
     */
    public static function getCategoriesListAdmin()
    {
        // db connection
        $db = Db::getConnection();
        // db request
        $result = $db->query('SELECT id, name, slug, sort_order, status, description FROM product_category ORDER BY sort_order ASC');
        // get and return results
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
			$categoryList[$i]['slug'] = $row['slug'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
			$categoryList[$i]['description'] = $row['description'];
            $i++;
        }
        return $categoryList;
    }
}