<?php
session_start();
$connect = mysqli_connect('localhost','root','','db_backoffice');
$stm = $connect->prepare("select * from category where 1");
$stm -> execute();
$result = $stm->get_result();
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
        <select name="category" id="cars">
            <?php
            while($row = $result-> fetch_assoc()):
            ?>
            <option value="<?php echo $row['ID']; ?>"><?php echo $row['Names']; ?></option>
            <?php endwhile; ?>
        </select>
        Product name
        <input type="text" name="product_name">
        Price
        <input type="number" name="product_price" id="">
        quantity
        <input type="number" name="product_quantity" id="">
        description
        <textarea name="product_description" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="submit" name="submit">
    </form>
</body>

</html>