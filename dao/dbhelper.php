<?php
define('HOST','localhost');
define('DATABASE','dbbook');
define('USERNAME','root');
define('PASSWORD','');
function execute($sql) {
	//create connection toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	//query
	mysqli_query($conn, $sql);

	//dong connection
	mysqli_close($conn);
}

function executeResult($sql) {
	//create connection toi database
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	//query
	$resultset = mysqli_query($conn, $sql);
	$list      = [];
	while ($row = mysqli_fetch_array($resultset, 1)) {
		$list[] = $row;
	}

	//dong connection
	mysqli_close($conn);

	return $list;
}

function  insert_shippingTable($fullname,$phone,$address,$note,$account_id){
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	$stmt = $conn->prepare('INSERT INTO shipping(fullname,phone,address,note,account_id) VALUES(?,?,?,?,?)');
	$stmt->bind_param('sssss',$fullname,$phone,$address,$note,$account_id);
	$stmt->execute();
	mysqli_close($conn);

}

function login($username, $password) {
	$dbConnection = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	$stmt = $dbConnection->prepare('SELECT users.login_id, account.id as accountId
	FROM ((users 
	INNER JOIN customer ON users.login_id = customer.user_login_id)
	INNER JOIN account ON customer.id = account.customer_id)
	WHERE users.login_id = ? AND users.password = ? ');
	$stmt->bind_param("is", $username, $password);
	$stmt->execute();

	$result = $stmt->get_result();
	$res = mysqli_fetch_assoc($result);
	mysqli_close($dbConnection);
	return $res;
}

function register($login_id, $password, $email, $phone, $address) {
	if(!empty($login_id) && !empty($password) 
	&& !empty($email) && !empty($phone) && !empty($address)) {
		$customerId = uniqid("customer");
		$accountId = uniqid("account");

		$mysqli = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

		//transaction
		$mysqli->query("START TRANSACTION");
		//insert into users
		$stmt = $mysqli->prepare('INSERT INTO users(login_id, password) VALUES (?, ?)');
		$stmt->bind_param('ss', $login_id, $password);
		$stmt->execute();

		//insert into customer
		$stmt = $mysqli->prepare('INSERT INTO customer (id, address, email, phone, user_login_id) VALUES(?, ? , ?, ?, ?)');
		$stmt->bind_param('sssss', $customerId , $address, $email, $phone, $login_id);
		$stmt->execute();


		//insert into account
		$stmt = $mysqli->prepare('INSERT INTO account (id, customer_id, open_date) VALUES(?, ? , ?)');
		$stmt->bind_param('sss', $accountId , $customerId, date('Y-m-d H:i:s'));
		$stmt->execute();

		$stmt->close();
		$result = $mysqli->query("COMMIT");

		if($result) {
			return true;
		}
		return false;
	}
}


//product

function addProductToCart($loginId, $accountId, $productId, $price) {
	if(!empty($loginId) && !empty($accountId) && !empty($productId) && !empty($price)) {
		$dbh = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USERNAME, PASSWORD);
		$stmt = $dbh->prepare("SELECT * from shopping_cart where account_id = ? AND user_login_id = ?");
		$stmt->bindParam(1, $accountId);
		$stmt->bindParam(2, $loginId);
		$stmt->execute();
		
		$addSucess = false;
		$resultShoppingCart = $stmt->fetchAll();
		if($stmt->rowCount() > 0)
		{
			//cập nhật giỏ hàng
			$stmt = $dbh->prepare("SELECT * from line_item where product_id = ? AND shopping_cartid = ? AND order_number IS NULL");
			$stmt->bindParam(1, $productId);
			$stmt->bindParam(2, $resultShoppingCart[0]['id']);
			$resultLineItem = $stmt->execute();
			//nếu product tồn tại và chưa được order thì cập nhật số lượng
			if($stmt->rowCount() > 0) {
				//update
				$sql = "UPDATE line_item SET quantity = quantity + 1 WHERE product_id = ? AND shopping_cartid = ? AND order_number IS NULL";
				$addSucess = $dbh->prepare($sql)->execute([$productId, $resultShoppingCart[0]['id']]);
			}
			else {
				//tạo mới line_item
				$sql = "INSERT INTO line_item(order_number, price, product_id, quantity, shopping_cartid) VALUES(?, ?, ?, ?, ?)";
				$addSucess = $dbh->prepare($sql)->execute([NULL, $price, $productId, 1, $resultShoppingCart[0]['id']]);
			}
		}
		else {
			//tạo mới giỏ hàng
			$sql = "INSERT INTO shopping_cart(account_id, created, user_login_id) VALUES(?, ?, ?)";
			$dbh->prepare($sql)->execute([$accountId, date('Y-m-d H:i:s'), $loginId]);

			//thêm sản phẩm vào giỏ hàng
			$sql = "INSERT INTO line_item(order_number, price, product_id, quantity, shopping_cartid) VALUES(?, ?, ?, ?, ?)";
			$addSucess = $dbh->prepare($sql)->execute([NULL, $price, $productId, 1, $dbh -> lastInsertId()]);
		}
		return $addSucess;
	}
}

function getLineItemsInCart($cartId) {
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn,"utf8");
	$query = "SELECT product.id, product.name, product.price, product.image, line_item.id AS lineItemId, line_item.quantity FROM product JOIN line_item ON product.id = line_item.product_id WHERE line_item.shopping_cartid = ".$cartId." AND line_item.order_number IS NULL;";
	
	$resultset = mysqli_query($conn, $query);
	$list = [];
	while ($row = mysqli_fetch_array($resultset, 1)) {
		$list[] = $row;
	}

	//print_r($list);
	//dong connection
	mysqli_close($conn);
	return $list;
}

function getCart($loginId, $accountId) {
	$dbh = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USERNAME, PASSWORD);
	$stmt = $dbh->prepare("SELECT * FROM shopping_cart WHERE account_id = ? AND user_login_id = ?");
	$stmt->bindParam(1, $accountId);
	$stmt->bindParam(2, $loginId);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}
function getAllProducts() {
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	$query = "SELECT * FROM product";
	
	$resultset = mysqli_query($conn, $query);
	$list = [];
	while ($row = mysqli_fetch_array($resultset, 1)) {
		$list[] = $row;
	}

	//print_r($list);
	//dong connection
	mysqli_close($conn);
	return $list;
}

function increaseQuantity($lineItemId) {
	$dbh = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USERNAME, PASSWORD);
	$sql = "UPDATE line_item SET quantity = quantity + 1 WHERE id = ?";
	$dbh->prepare($sql)->execute([$lineItemId]);	
}

function decreaseQuantity($lineItemId) {
	$dbh = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USERNAME, PASSWORD);
	$sql = "UPDATE line_item SET quantity = quantity - 1 WHERE id = ?";
	$dbh->prepare($sql)->execute([$lineItemId]);	
}

function deleteItemFromCart($lineItemId) {
	$dbh = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USERNAME, PASSWORD);
	$sql = "DELETE FROM line_item WHERE id = ?";
	$dbh->prepare($sql)->execute([$lineItemId]);
}

function getProductDetail($productId) {
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn,"utf8");
	$query = "SELECT * FROM product WHERE id = $productId";
	$resultset = mysqli_query($conn, $query);
	$res = mysqli_fetch_assoc($resultset);
	return $res;
}

function getAllCategories() {
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	mysqli_set_charset($conn,"utf8");
	$query = "SELECT * FROM categories";
	
	$resultset = mysqli_query($conn, $query);
	$list = [];
	while ($row = mysqli_fetch_array($resultset, 1)) {
		$list[] = $row;
	}

	//print_r($list);
	//dong connection
	mysqli_close($conn);
	return $list;
}

function getProducts($categoryId) {
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	$query = "SELECT * FROM product WHERE category_int = $categoryId";
	mysqli_set_charset($conn,"utf8");
	$resultset = mysqli_query($conn, $query);
	$list = [];
	while ($row = mysqli_fetch_array($resultset, 1)) {
		$list[] = $row;
	}
	//print_r($list);
	//dong connection
	mysqli_close($conn);
	return $list;
}