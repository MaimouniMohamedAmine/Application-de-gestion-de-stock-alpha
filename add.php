<?php
session_start();
$connect = mysqli_connect('localhost','root','','db_backoffice');
$select = $connect->prepare("select * from category where 1");
$select -> execute();
$result = $select -> get_result();
$update= 0;

$product_name = '' ;
$product_price = '';
$product_quantity = '';
$product_description = '';
if(isset($_GET['edit']))
{
    $update = 1;
    $edit_id = $_GET['edit'];
    $_SESSION['Id'] = $_GET['edit'];
    $select_edit = $connect -> prepare("select * from category INNER JOIN product ON category.ID = product.Category_id WHERE product.ID = $edit_id");
    $select_edit -> execute();
    $result_edit = $select_edit -> get_result();
    $row_edit = $result_edit -> fetch_assoc();
    $select_category = $row_edit['Cat_name'];
    $product_name = $row_edit['Name'] ;
    $product_price = $row_edit['Price'];
    $product_quantity = $row_edit['Quantity'];
    $product_description = $row_edit['Description'];

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style\add.css">
    <title>Document</title>
</head>

<body>
    <form action="server.php" method="POST">
        Select category <br>
        <select name="category" id="cars">
            <?php
            while($row = $result-> fetch_assoc()):
            ?>

            <option value="<?php echo $row['ID']; ?>"><?php echo $row['Cat_name']; ?></option>
            <?php endwhile; ?>

        </select>
        Product name
        <input value=" <?php echo $product_name?>" type="text" name="product_name"><br>
        Price
        <input value=" <?php echo $product_price?>" type="text" name="product_price" id=""><br>
        quantity
        <input value=" <?php echo $product_quantity?>" type="text" name="product_quantity" id=""><br>
        description
        <textarea name="product_description" type="text" cols="30"
            rows="10"><?php echo $product_description;?></textarea>
        <?php
            if($update == 0) :
            ?>
        <input type="submit" value="submit" name="submit">
        <?php
    else : 
    ?>
        <input type="submit" value="edit" name="edit_btn">
        <?php
endif;
?>
    </form>

</body>

</html>