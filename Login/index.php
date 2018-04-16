<?php
session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'admin');
define('DB_NAME', 'cars');

$connection = mysqli_connect('localhost', 'root', 'admin');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'cars');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
//echo "Connected to DB successfully.";

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `user` WHERE e_mail='$username' and password='$password'";

    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $_SESSION['username'] = $username;
    } else {
        $fmsg = "Neteisingi prisijungimo duomenys.";
    }
}
elseif (isset($_GET['logout'])){
session_start();
session_destroy();
header('Location: ' . $_SERVER['PHP_SELF']);
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
        }
        else {
        ?>
            <form   name="login" action="" method="post">
                Username: <input type="text" name="username" value="" /><br />
                Password: <input type="password" name="password" value="" /><br />
                <input type="submit" name="submit" value="Submit" />
            </form>
            <?php
                if (!empty($fmsg)){
                    echo $fmsg;
                }
             ?>
        <?php
        }
    ?>
</body>
</html>