<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])){echo "<script>window.location='login.php';</script>";exit;}
$uid=$_SESSION['user_id'];
$emails=$conn->query("SELECT * FROM emails WHERE sender_id='$uid' AND folder='sent' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Sent Emails</title>
<style>
body{font-family:'Segoe UI';background:#f6f8fc;}
.mail{background:#fff;margin:10px auto;width:80%;padding:15px;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
.mail:hover{transform:scale(1.01);transition:0.2s;}
h2{text-align:center;color:#4285f4;}
.btn{display:block;text-align:center;margin:20px;}
button{background:#4285f4;color:white;border:none;padding:10px 15px;border-radius:6px;cursor:pointer;}
button:hover{background:#3367d6;}
</style>
<script>function go(p){window.location=p;}</script>
</head>
<body>
<h2>📤 Sent Emails</h2>
<div class="btn"><button onclick="go('index.php')">⬅️ Back to Inbox</button></div>
<?php while($m=$emails->fetch_assoc()): ?>
<div class="mail">
<b>To:</b> User #<?php echo $m['receiver_id']; ?><br>
<b>Subject:</b> <?php echo htmlspecialchars($m['subject']); ?><br>
<small><?php echo date('M d, Y h:i A', strtotime($m['created_at'])); ?></small>
</div>
<?php endwhile; ?>
</body>
</html>
