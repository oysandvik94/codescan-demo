<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['db'] = function() {
    return new PDO('mysql:host=localhost;dbname=vulnerable', 'vulnerable', 'vulnerable');
};

$app->get('/profile', function(Silex\Application $app){
    /** @var PDO $db */
    $db = $app['db'];
    $id = $_GET['id'];

    $statement = $db->query("SELECT * FROM users WHERE id = $id");

    $results = $statement->fetchAll();
    $user = $results[0];
    return <<<EOF
    <dl>
    <dt>Username:</dt><dd>{$user['username']}</dd>
    <dt>Email:</dt><dd>{$user['email']}</dd>
    <dt>Full Name:</dt><dd>{$user['fullname']}</dd>
    <dt>Bio:</dt><dd>{$user['bio']}</dd>
    </dl>
EOF;
});
$app->get('/login', function(){

    return <<<EOF
    <form action="/login" method="post">
    <label>Username: <input type="text" name="username" /></label>
    <label>Password: <input type="password" name="password" /></label>
    <input type="submit" value="submit" />
    </form>
           
EOF;
});

$app->post('/login', function(Silex\Application $app) {

    /** @var PDO $db */
    $db = $app['db'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $statement = $db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    $results = $statement->fetchAll();
    if(count($results) > 0) {
        return "Authenticated as " . $results[0]['username'];
    } else {
        return "Invalid username/password";
    }

    if ($_SESSION['user_logged_in'] !== true) {
        header('Location: /login.php');
    }
    
    omg_important_private_functionality_here();
});

<?
$a = htmlentities($_GET['a']);
$b = $_GET['b'];
$c = $_GET['c'];
$d = htmlentities($b);

echo ($a); // safe
echo (htmlentities($b)); // safe
echo ($c); // XSS vulnerability
echo ($d); // safe
echo (htmlentities($_GET['id']); // safe
?>

<html>
<? $name = $_GET['name']; // Comment ?><? echo($name); // XSS 1 ?>
<script>
document.write('<? echo($_GET['city']); // XSS 2 ?>');
</script>
</html>

<html>
<?php
$name = $_GET['name'];
$msg = 'Welcome '.$name;
?>
<head>
<title><? echo($name); /* XSS 1 */ ?></title>
</head>
<body>
<? echo($msg); /* XSS 2 */ ?>
</body>
</html>

<?
$name = $_GET['name'];
?>
<?=$_GET['name']; //XSS 1 ?>
<?=$name // XSS 2 ?>

<html>
<script language="php">
$d = $_GET['d'];
echo($d); // XSS
</script>
</html>

<?
echo($_GET['name']); // XSS 1
echo($_POST['name']); // XSS 2
echo($_REQUEST['name']); // XSS 3
?>

<?
$username = $_GET['username'];
$result=mysql_query('SELECT * FROM users WHERE username="'.$username.'"');
?>

<?
$cmd = $_GET['command'];
passthru('SomeApp.exe '.$cmd);
?>

$app->run();