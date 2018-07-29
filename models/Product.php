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
	 * @return array <p>Array with products</p>
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
	
	 /**
     * Return product list
     * @return array <p>Array of products</p>
     */
    public static function getProductsList()
    {
        // db connection
        $db = Db::getConnection();
        // Request and return of the results
        $result = $db->query('SELECT id, name, slug, category_id, price, code FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
			$productsList[$i]['slug'] = $row['slug'];
			$productsList[$i]['category_id'] = $row['category_id'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
			
			$categoryArr = Product::getCategoryNameById($row['category_id']);
			$productsList[$i]['category_slug'] = $categoryArr['slug'];
            $i++;
        }
        return $productsList;
    }
	
	/**
     * Removes product with id
     * @param integer $id <p>id of the product</p>
     * @return boolean <p>Method result</p>
     */
    public static function deleteProductById($id)
    {
        // db connection
        $db = Db::getConnection();
        // db request
        $sql = 'DELETE FROM product WHERE id = :id';
        // result return
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
	
	/**
     * Add new product
     * @param array $options <p>Array with product data</p>
     * @return integer <p>id of the db table row</p>
     */
    public static function createProduct($options)
    {
        // db connection
        $db = Db::getConnection();
        // db request
        $sql = 'INSERT INTO product '
                . '(name, slug, code, price, category_id, brand, availability,'
                . 'description, old_price, is_new, is_recommended, is_promo, status)'
                . 'VALUES '
                . '(:name, :slug, :code, :price, :category_id, :brand, :availability,'
                . ':description, :old_price, :is_new, :is_recommended, :is_promo, :status)';
        // result return
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
		$result->bindParam(':slug', $options['slug'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
		$result->bindParam(':old_price', $options['old_price'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
		$result->bindParam(':is_promo', $options['is_promo'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            // if request is successful, return id of the added row
            return $db->lastInsertId();
        }
        // or return 0
        return 0;
    }
	
	/**
     * Edit product by some id
     * @param integer $id <p>id of the product</p>
     * @param array $options <p>Array with product data</p>
     * @return boolean <p>Method execution result</p>
     */
    public static function updateProductById($id, $options)
    {
        // db connection
        $db = Db::getConnection();
        // db request
        $sql = "UPDATE product
            SET 
                name = :name, 
				slug = :slug,
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description,
				old_price = :old_price, 				
                is_new = :is_new, 
                is_recommended = :is_recommended, 
				is_promo = :is_promo,
                status = :status
            WHERE id = :id";
        // result get and return
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
		$result->bindParam(':slug', $options['slug'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
		$result->bindParam(':old_price', $options['old_price'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
		$result->bindParam(':is_promo', $options['is_promo'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }
	
	/**
     * Returns path to the product image
     * @param integer $id
     * @return string <p>Path to the image</p>
     */
    public static function getImage($id)
    {
        // Default empty image name
        $noImage = 'no-image.png';
        // Path to the product image folder
        $path = '/upload/images/products/';
        // Path to product image
        $pathToProductImage = $path . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // If image exists
            // return path to image
            return $pathToProductImage;
        }
        // else - return path to the default image
        return $path . $noImage;
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