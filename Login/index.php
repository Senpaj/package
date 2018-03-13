<?php
session_start();
/**
 * Created by PhpStorm.
 * User: justas
 * Date: 18.3.13
 * Time: 10.15
 */

include "User.php";

$user = new User();
$user->username = "John";
$user->password = "123";
$user->email = "John@mail.com";

if(isset($_GET['logout'])) {
    $_SESSION['username'] = '';
    header('Location: ' . $_SERVER['PHP_SELF']);
}

if(isset($_POST['username'])){
    if($_POST['username'] === $user->username && $_POST['password'] === $user
    ->password){
    $_SESSION['username'] = $_POST['username'];
    } else {
        echo "Invalid login";
    }
}
?>


<html>
<head>
    <title>Login</title>
</head>

<body>
    <?php
        if(!empty($_SESSION['username'])){
            ?>
            <p>
            You are logged in as <?php echo $_SESSION['username']?><br />
            <a href="?logout=1">Logout</a>
            </p>
        <?php
        } else {
        ?>
            <form   name="login" action="" method="post">
                Username: <input type="text" name="username" value="" /><br />
                Password: <input type="password" name="password" value="" /><br />
                <input type="submit" name="submit" value="Submit" />
            </form>
        <?php
        }
    ?>
</body>
</html>