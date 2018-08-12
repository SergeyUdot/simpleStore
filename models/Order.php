<?php

class Order
{

    /**
     * Save Order
     * @param type $name
     * @param type $email
     * @param type $password
     * @return type
     */
    public static function save($userName, $userPhone, $userEmail, $userComment, $userId, $products)
    {
        $products = json_encode($products);

        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_email, user_comment, user_id, products) '
                . 'VALUES (:user_name, :user_phone, :user_email, :user_comment, :user_id, :products)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
		$result->bindParam(':user_email', $userEmail, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }
	
	/**
     * Return Order list
     * @return array <p>Order List</p>
     */
    public static function getOrdersList()
    {
        // db connection
        $db = Db::getConnection();
        // Get and return results
        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }
	
    /**
     * Return text status of the order:<br/>
     * <i>1 - New order, 2 - In processing, 3 - In delivery, 4 - Done</i>
     * @param integer $status <p>Status</p>
     * @return string <p>Text description of the status</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'New order';
                break;
            case '2':
                return 'In processing';
                break;
            case '3':
                return 'In delivery';
                break;
            case '4':
                return 'Done';
                break;
        }
    }
	
    /**
     * Return order with id 
     * @param integer $id <p>id</p>
     * @return array <p>Array with data of the current order</p>
     */
    public static function getOrderById($id)
    {
        // db connection
        $db = Db::getConnection();
        // db request text
        $sql = 'SELECT * FROM product_order WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // set result data as array
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // make requesr
        $result->execute();
        // return data
        return $result->fetch();
    }
	
    /**
     * Delete order with id
     * @param integer $id <p>id of the order</p>
     * @return boolean <p>Method result</p>
     */
    public static function deleteOrderById($id)
    {
        // db connection
        $db = Db::getConnection();
        // db request text
        $sql = 'DELETE FROM product_order WHERE id = :id';
        // Get and return results. Prepared request is used
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
	
    /**
     * Edit order with id
     * @param integer $id <p>id of the product</p>
     * @param string $userName <p>User name</p>
     * @param string $userPhone <p>User phone</p>
     * @param string $userComment <p>User comment</p>
     * @param string $date <p>Order date</p>
     * @param integer $status <p>Status <i>(on "1", off "0")</i></p>
     * @return boolean <p>Method result</p>
     */
    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status)
    {
        // db connection
        $db = Db::getConnection();
        // db request text
        $sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";
        // Get and return results. Prepared request is used
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
	
	// Get orders of the user
	public static function getOrdersByUser($userId)
    {
        // db connection
        $db = Db::getConnection();
        // db request text
        $sql = 'SELECT * FROM product_order WHERE user_id = :user_id ORDER BY id ASC LIMIT 25';
		$result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->execute();
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
			$ordersList[$i]['products'] = $row['products'];
            $i++;
        }
        return $ordersList;
    }

}