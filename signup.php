<?php
include 'db.php';
if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
    if($conn->query($sql)){
        echo "<script>alert('Account created! Please login');window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: Email already exists');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Signup - Gmail Clone</title>
<style>
body{background:#f6f8fc;font-family:'Segoe UI';}
.box{width:400px;margin:60px auto;background:#fff;padding:30px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.1);}
h2{text-align:center;color:#4285f4;}
input{width:100%;padding:10px;margin:10px 0;border:1px solid #ddd;border-radius:6px;}
button{background:#4285f4;color:white;border:none;padding:10px;width:100%;border-radius:6px;font-size:16px;cursor:pointer;}
button:hover{background:#3367d6;}
</style>
</head>
<body>
<div class="box">
<h2>Create Account</h2>
<form method="POST">
<input type="text" name="name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="signup">Sign Up</button>
<p style="text-align:center;">Already have an account? <a href="login.php">Login</a></p>
</form>
</div>
</body>
</html>
