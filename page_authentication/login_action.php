<?php
require_once ('./../dao/dbhelper.php');
require_once ('./../shared/config.php');
session_start();
$s_username = $s_password = '';

if (!empty($_POST)) {
	$s_id = '';

	if (isset($_POST['username'])) {
		$s_username = $_POST['username'];
	}

	if (isset($_POST['password'])) {
		$s_password = $_POST['password'];
	}

    $s_username = str_replace('\'', '\\\'', $s_username);
	$s_password      = str_replace('\'', '\\\'', $s_password);

    $data = login($s_username,$s_password);
    if($data != null ){
        //set session
        $_SESSION[S_ACCOUNT_ID] = $data['accountId'];
        $_SESSION[S_USERNAME] = $s_username;
        header('Location: ./../index.php');
        echo "Success";
        
    }
    else {
        echo "Fail";
    }
}
?>