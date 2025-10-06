<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $res = $conn->query("SELECT * FROM users WHERE email='$email'");
  if($res->num_rows > 0){
    $row = $res->fetch_assoc();
    if(password_verify($password, $row['password'])){
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      echo "<script>window.location='index.php';</script>";
    } else {
      echo "<script>alert('Wrong password');</script>";
    }
  } else {
    echo "<script>alert('Email not found');</script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login - Gmail Clone</title>
<style>
body{background:#f6f8fc;font-family:'Segoe UI';}
.box{width:400px;margin:60px auto;background:#fff;padding:30px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.1);}
h2{text-align:center;color:#34a853;}
input{width:100%;padding:10px;margin:10px 0;border:1px solid #ddd;border-radius:6px;}
button{background:#34a853;color:white;border:none;padding:10px;width:100%;border-radius:6px;font-size:16px;cursor:pointer;}
button:hover{background:#0f9d58;}
</style>
</head>
<body>
<div class="box">
<h2>Login</h2>
<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
<p style="text-align:center;">Don't have an account? <a href="signup.php">Signup</a></p>
</form>
</div>
</body>
</html>
