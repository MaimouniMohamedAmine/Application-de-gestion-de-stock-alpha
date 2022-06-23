<?php
session_start();
$connect = mysqli_connect('localhost','root','','db_backoffice');
if (isset($_POST['submit']))
{
    $select_category = $_POST['category'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_description = $_POST['product_description'];
    $insert_req = "INSERT INTO product (Category_id,Name,Price,Quantity,Description) values ('$select_category','$product_name','$product_price','$product_quantity','$desc')";    
    $insert_req_query = mysqli_query($connect,$insert_req);
    header('Location: product_list.php');
}
if (isset($_POST['edit_btn']))
{
    $id = $_SESSION['Id'];
    $select_category = $_POST['category'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_description = $_POST['product_description'];
    // $update_req = $connect->query("UPDATE `product` SET `Category_id`= '$select_category',`Name`= '$product_name',`Price`= '$product_price',`Quantity`= '$product_quantity' ,`Description` = '$product_description' WHERE `ID` = $id ");  
    $update_req = $connect->query("UPDATE `product` SET `Category_id`='$select_category',`Name`='$product_name',`Price`='$product_price', `Quantity`= '$product_quantity', `Description` = '$product_description' WHERE `ID` = '$id' ")or die(mysqli_error($conn));  
    // $update_req_query = mysqli_query($connect,$insert_req);
    header('Location: product_list.php');
    
}