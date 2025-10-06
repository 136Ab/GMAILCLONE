<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])) {
  echo "<script>window.location='login.php';</script>"; exit;
}
if(isset($_POST['send'])){
  $sender_id = $_SESSION['user_id'];
  $to = $_POST['to'];
  $subject = $_POST['subject'];
  $body = $_POST['body'];

  $recv = $conn->query("SELECT id FROM users WHERE email='$to'")->fetch_assoc();
  if($recv){
    $rid = $recv['id'];
    $conn->query("INSERT INTO emails (sender_id,receiver_id,subject,body,folder) VALUES ('$sender_id','$rid','$subject','$body','sent')");
    $conn->query("INSERT INTO emails (sender_id,receiver_id,subject,body,folder) VALUES ('$sender_id','$rid','$subject','$body','inbox')");
    echo "<script>alert('Email Sent Successfully!');window.location='sent.php';</script>";
  } else {
    echo "<script>alert('Receiver not found');</script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Compose Email</title>
<style>
body{background:#f6f8fc;font-family:'Segoe UI',sans-serif;}
.box{width:600px;margin:50px auto;background:#fff;padding:25px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.1);}
input,textarea{width:100%;padding:10px;margin:10px 0;border:1px solid #ddd;border-radius:6px;}
button{background:#4285f4;color:white;border:none;padding:10px 20px;border-radius:6px;font-size:16px;cursor:pointer;}
button:hover{background:#3367d6;}
</style>
<script>
function go(p){window.location=p;}
</script>
</head>
<body>
<div class="box">
<h2>✉️ Compose Email</h2>
<form method="POST">
<input type="email" name="to" placeholder="To (email address)" required>
<input type="text" name="subject" placeholder="Subject" required>
<textarea name="body" placeholder="Write your message..." rows="8"></textarea>
<button type="submit" name="send">Send</button>
<button type="button" onclick="go('index.php')">Back</button>
</form>
</div>
</body>
</html>
