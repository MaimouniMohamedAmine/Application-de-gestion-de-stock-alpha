<?php
session_start();
$connect = mysqli_connect('localhost','root','','db_backoffice');
$select = $connect->prepare("select * from category where 1");
$select -> execute();
$result = $select -> get_result();
$update= 0;
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $select_login = $connect -> prepare("select * from admin where username ='".$username."' AND password = '".$password."'");
    $select_login -> execute();
    $result_login = $select_login -> get_result();
    $row_login = $result_login -> fetch_assoc();
    $user_res = $row_login['username'];
    $psw_res = $row_login['password'];

    if($user_res == $username && $psw_res == $password)
    {
        $_SESSION['session'] = true;  
        header('Location: dashboard.php');
    } else{
        $_SESSION['session'] = false;
        header('Location: login.php');
    }
    if($username == '' && $password =='' )
    {
        $_SESSION['session'] = false;
        header('Location: login.php');
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/login.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <title>Login | MANAGE verse</title>
</head>

<body>
    <h1 id="admin_login_title">Admin login</h1>
    <main class="container">
        <div class="center_div">
            <div id="logo_div">
                <img id="logo" src="/Logo/logo.png" alt="" />
            </div>
            <div>
                <form class="login_form" action="login.php" method='POST'>
                    <label class="login_label">Username</label><br />
                    <input name='username' class="login_input" type="text" /><br />
                    <label class="login_label">Password</label><br />
                    <input name='password' class="login_input" type="password" /><br />
                    <?php
                    if(isset($_SESSION['session']))
                    {   
                        if($_SESSION['session'] == false) {
                            echo "<small id='small_msg' > The username or password is wrong</small><br>";}
                            else{
                                echo " ";
                            }
                    }
                        ?>
                    <input id="login_btn" type="submit" name='submit' value="LOGIN" />

                </form>
            </div>
        </div>
    </main>
</body>

</html>