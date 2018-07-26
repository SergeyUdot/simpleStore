<?php 

class Product
{
	
	const SHOW_BY_DEFAULT = 8;
	
	/**
	 * Returns an array of products
	 */
	public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
	{
		$count = intval($count);
		
		$db = Db::getConnection();
		
		$productsList = array();
		
		$result = $db->query('SELECT id, name, slug, price, old_price, image, is_new, is_promo, category_id FROM product '
				. 'WHERE status="1" '
				. 'ORDER BY id DESC '
				. 'LIMIT ' . $count);
		
		$i = 0;
		while($row = $result->fetch()) {
			$productsList[$i]['id'] = $row['id'];
			$productsList[$i]['name'] = $row['name'];
			$productsList[$i]['slug'] = $row['slug'];
			$productsList[$i]['price'] = $row['price'];
			$productsList[$i]['old_price'] = $row['old_price'];
			$productsList[$i]['image'] = $row['image'];
			$productsList[$i]['is_new'] = $row['is_new'];
			$productsList[$i]['is_promo'] = $row['is_promo'];
			
			$categoryArr = Product::getCategoryNameById($row['category_id']);
			$productsList[$i]['category_slug'] = $categoryArr['slug'];
			$i++;
		}
		
		return $productsList;
	}
	
	/**
	 * Returns an array of products for category
	 */
	public static function getProductsListByCategory($category = false, $page = 1)
	{
		if($category) {
			$page = intval($page);
			$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
			
			$db = Db::getConnection();
		
			$products = array();
		
			$catRes = $db->query('SELECT id, name, description FROM product_category WHERE `slug`="'.$category.'"');
		
			$catRes->setFetchMode(PDO::FETCH_ASSOC);
			$categoryRow = $catRes->fetch();
		
			$result = $db->query("SELECT id, name, slug, price, old_price, image, is_new, is_promo FROM product "
			        . "WHERE status='1' AND category_id='".$categoryRow['id']."' "
					. "ORDER BY id DESC "
					. "LIMIT ".self::SHOW_BY_DEFAULT
					. " OFFSET ". $offset);
		
			$i = 0;
			while($row = $result->fetch()) {
				$products[$i]['id'] = $row['id'];
				$products[$i]['name'] = $row['name'];
				$products[$i]['slug'] = $row['slug'];
				$products[$i]['price'] = $row['price'];
				$products[$i]['old_price'] = $row['old_price'];
				$products[$i]['image'] = $row['image'];
				$products[$i]['is_new'] = $row['is_new'];
				$products[$i]['is_promo'] = $row['is_promo'];
				$products[$i]['category_slug'] = $category;
				$products[$i]['category_name'] = $categoryRow['name'];
				$i++;
			}
			if(count($products)==0) {
				$products[$i]['category_slug'] = $category;
				$products[$i]['category_name'] = $categoryRow['name'];
			}
		
			return $products;
		}
	}
	
	public static function getProductById($id)
	{
		$id = intval($id);
		if($id) {
			$db = Db::getConnection();
			
			$result = $db->query('SELECT * FROM product WHERE `id`="'.$id.'"');
			$result->setFetchMode(PDO::FETCH_ASSOC);
			
			return $result->fetch();
		}	
	}
	
	/**
	 * Returns total amount of products for category
	 */
	public static function getTotalProductsInCategory($category)
	{
		$category_id = Product::getCategoryIdBySlug($category)['id'];
		$db = Db::getConnection();
		
		$result = $db->query('SELECT count(id) AS count FROM product WHERE status="1" AND `category_id`="'.$category_id.'"');
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result->fetch();
		
		return $row['count'];
	}
	
	/**
	 * Returns products
	 */
	public static function getProductsByIds($idsArray)
	{
		$products = array();
		
		$db = Db::getConnection();
		
		$idsString = implode(',', $idsArray);
		
		$sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";
		
		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		$i = 0;
		while($row = $result->fetch()) {
			$products[$i]['id'] = $row['id'];
			$products[$i]['code'] = $row['code'];
			$products[$i]['name'] = $row['name'];
			$products[$i]['price'] = $row['price'];
			$products[$i]['slug'] = $row['slug'];
			$products[$i]['category_id'] = $row['category_id'];
			
			$categoryArr = Product::getCategoryNameById($row['category_id']);
			$products[$i]['category_slug'] = $categoryArr['slug'];
			$i++;
		}
		
		return $products;
	}
	
	/**
     * Returns an array of recommended products
     */
    public static function getRecommendedProducts()
    {
        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT id, name, slug, price, old_price, image, is_new, is_promo, category_id FROM product '
                . 'WHERE status = "1" AND is_recommended = "1"'
                . 'ORDER BY id DESC ');

        $i = 0;
		while($row = $result->fetch()) {
			$productsList[$i]['id'] = $row['id'];
			$productsList[$i]['name'] = $row['name'];
			$productsList[$i]['slug'] = $row['slug'];
			$productsList[$i]['price'] = $row['price'];
			$productsList[$i]['old_price'] = $row['old_price'];
			$productsList[$i]['image'] = $row['image'];
			$productsList[$i]['is_new'] = $row['is_new'];
			$productsList[$i]['is_promo'] = $row['is_promo'];
			
			$categoryArr = Product::getCategoryNameById($row['category_id']);
			$productsList[$i]['category_slug'] = $categoryArr['slug'];
			$i++;
		}

        return $productsList;
    }
	
	private static function getCategoryNameById($category_id)
	{
		$db = Db::getConnection();
		$catRes = $db->query('SELECT name,slug FROM product_category WHERE `id`="'.$category_id.'"');
		$catResIt = $catRes->fetch();
		return $catResIt;
	}
	
	private static function getCategoryIdBySlug($category)
	{
		$db = Db::getConnection();
		$catRes = $db->query('SELECT id,name FROM product_category WHERE `slug`="'.$category.'"');
		$catResIt = $catRes->fetch();
		return $catResIt;
	}
		
}