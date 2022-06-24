<?php
session_start();
$connect = mysqli_connect('localhost','root','','db_backoffice');
$select = $connect->prepare("select * from category where 1"); $select -> execute(); $result = $select -> get_result(); 
$update= 0;
$product_name = '' ;
$product_price = '';
$product_quantity = '';
$product_description = ''; 
if(isset($_GET['edit'])) {
    $update = 1; $edit_id = $_GET['edit']; $_SESSION['Id'] = $_GET['edit'];
    $select_edit = $connect -> prepare("select * from category INNER JOIN product ON category.ID = product.Category_id WHERE product.ID = $edit_id");
    $select_edit -> execute(); $result_edit = $select_edit -> get_result();
    $row_edit = $result_edit -> fetch_assoc(); 
    $select_category = $row_edit['Cat_name']; 
    $product_name = $row_edit['Name'] ;
    $product_price = $row_edit['Price']; $product_quantity = $row_edit['Quantity']; $product_description = $row_edit['Description']; } ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/style/product_list.css" />

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style\add.css" />
    <title>Add | MANAGE verse</title>
</head>

<body>
    <main class="container">
        <div id="logo_div">
            <img id="logo" src="/Logo/logo.png" alt="" />
        </div>
        <div class="form_container">
            <form class="add_form" action="server.php" method="POST">
                <label class="form_label">Select category</label><br />
                <br />
                <select class="form_input" aria-label="Default select example" name="category" id="cars">
                    <?php
                            while($row = $result->fetch_assoc()): 
                        ?>
                    <option value="<?php echo $row['ID']; ?>"><?php echo $row['Cat_name']; ?></option>
                    <?php endwhile; ?>
                </select><br />
                <label class="form_label">Product name</label><br />
                <input class="form_input" value=" <?php echo $product_name?>" type="text" name="product_name" /><br />
                <label class="form_label">Price</label><br />
                <input class="form_input" value=" <?php echo $product_price?>" type="text" name="product_price"
                    id="" /><br />
                <label class="form_label">Quantity</label><br />
                <input class="form_input" value=" <?php echo $product_quantity?>" type="text" name="product_quantity"
                    id="" /><br />
                <label class="form_label">Description</label><br />
                <textarea class="form_input" name="product_description" type="text" cols="30"
                    rows="10"><?php echo $product_description;?></textarea><br />
                <?php
                            if($update == 0) :
                    ?>
                <input type="submit" value="SUBMIT" name="submit" />
                <?php
                        else : 
                        ?>
                <input type="submit" value="EDIT" name="edit_btn" class="edit_btn" />
                <?php
                        endif;
                    ?>
            </form>
        </div>
    </main>
</body>

</html>