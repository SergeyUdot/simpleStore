<?php

class Category 
{
	/* Product Category */
	
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
	
	/**
     * Removes category with id
     * @param integer $id
     * @return boolean <p>Method evaluation result</p>
     */
    public static function deleteCategoryById($id)
    {
        // db connection
        $db = Db::getConnection();
        // db request
        $sql = 'DELETE FROM product_category WHERE id = :id';
        // get and return results
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
	
    /**
     * Edit category with id
     * @param integer $id <p>id of the category</p>
     * @param string $name <p>Name</p>
	 * @param string $slug <p>URL name</p>
     * @param integer $sortOrder <p>Order number/sort order</p>
     * @param integer $status <p>Status <i>(on "1", off "0")</i></p>
     * @return boolean <p>Method result</p>
     */
    public static function updateCategoryById($id, $name, $slug, $sortOrder, $status, $description)
    {
        // db connection
        $db = Db::getConnection();
        // db request txt
        $sql = "UPDATE product_category
            SET 
                name = :name, 
				slug = :slug, 
                sort_order = :sort_order, 
                status = :status,
				description = :description
            WHERE id = :id";
        // get and return results
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':slug', $slug, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
		$result->bindParam(':description', $description, PDO::PARAM_STR);
        return $result->execute();
    }
	
	/**
     * Add new category
     * @param string $name <p>Name</p>
     * @param integer $sortOrder <p>Sort order</p>
     * @param integer $status <p>Status <i>(on "1", off "0")</i></p>
     * @return boolean <p>Method result</p>
     */
    public static function createCategory($name, $slug, $sortOrder, $status, $description)
    {
        // db connection
        $db = Db::getConnection();
        // db request
        $sql = 'INSERT INTO product_category (name, slug, sort_order, status, description) '
                . 'VALUES (:name, :slug, :sort_order, :status, :description)';
        // get and return results
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':slug', $slug, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
		$result->bindParam(':description', $description, PDO::PARAM_STR);
        return $result->execute();
    }
	
    /**
     * Return category with id
     * @param integer $id <p>id of the category</p>
     * @return array <p>Category data array</p>
     */
    public static function getCategoryById($id)
    {
        // db connection
        $db = Db::getConnection();
        // db request
        $sql = 'SELECT * FROM product_category WHERE id = :id';
        // prepared request
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // data as array
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // made request
        $result->execute();
        // return data
        return $result->fetch();
    }
	
	/**
     * Returns text description of the category status:<br/>
     * <i>0 - Hidden, 1 - Shown</i>
     * @param integer $status <p>Status</p>
     * @return string <p>Text description</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Shown';
                break;
            case '0':
                return 'Hidden';
                break;
        }
    }   
}