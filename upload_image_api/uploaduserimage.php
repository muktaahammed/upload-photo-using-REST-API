<?php

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $db = "dbschool";

$mysql = new mysqli ($servername, $username, $password, $db);

$response = array();

if($mysql->connect_error){
    $response["MESSAGE"] = "ERROR IN SERVER";
    $response["STATUS"] = 500;

}else{
    if (is_uploaded_file($_FILES["user_image"]["tmp_name"]) && @$_POST["user_name"]){

        $tmp_file = $_FILES["user_image"]["tmp_name"];
        $img_name = $_FILES["user_image"]["name"];
        $upload_dir = "./images/".$img_name;

        $sql = "INSERT INTO tbl_users(user_name, user_profile) VALUES ('{$_POST['user_name']}', '{$img_name}')";

        if(move_uploaded_file($tmp_file, $upload_dir) && $mysql->query($sql)){
            $response["MESSAGE"] = "UPLOAD SUCCESS";
            $response["STATUS"] = 200;

        }else{
            $response["MESSAGE"] = "UPLOAD FAILED";
            $response["STATUS"] = 404;
        }
    }else {
        $response["MESSAGE"] = "INVALIED REQUEST";
        $response["STATUS"] = 400;
    }
}


?>