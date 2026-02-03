<?php
session_start();
if(isset($_POST['user']) && isset($_POST['pass'])){
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Default credentials
    if($username=="admin" && $password=="admin"){
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<form method="post" style="max-width:400px;margin:50px auto;text-align:center;">
<h2>Admin Login</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<input name="user" placeholder="admin" required><br>
<input name="pass" placeholder="admin" required><br>
<button type="submit">Login</button>
</form>
</body>
</html>
