<?php
$connect = mysqli_connect('localhost','root','','db_backoffice');
if (isset($_POST['submit']))
{
    $select_category = $_POST['category'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_description = $_POST['product_description'];
    $insert_req = "INSERT INTO product (Category_id,Name,Price,Quantity,Description) values ('$select_category','$product_name','$product_price','$product_quantity','$product_description')";    
    $insert_req_query = mysqli_query($connect,$insert_req);
    header('Location: http://localhost/Application-de-gestion-de-stock/product_list.php');
}