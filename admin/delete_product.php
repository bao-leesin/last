<?php
include_once('db_conn.php');
if(isset($_GET['ID'])){
    $ID = $_GET['ID'];
    $sql = "DELETE FROM product WHERE ID =$ID";
    $query = mysqli_query($conn, $sql);
    if(query){
        header('location: admin_home.php');
    }
    else{
        echo "...";
    }
}
?>