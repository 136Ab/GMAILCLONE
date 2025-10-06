<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])){echo "<script>window.location='login.php';</script>";exit;}
$uid=$_SESSION['user_id'];
$emails=$conn->query("SELECT * FROM emails WHERE receiver_id='$uid' AND folder='trash' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Trash</title>
<style>
body{font-family:'Segoe UI';background:#f6f8fc;}
.mail{background:#fff;margin:10px auto;width:80%;padding:15px;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
.mail:hover{transform:scale(1.01);transition:0.2s;}
h2{text-align:center;color:#d93025;}
button{background:#d93025;color:white;border:none;padding:10px;border-radius:6px;cursor:pointer;}
button:hover{background:#b22b1c;}
</style>
<script>function go(p){window.location=p;}</script>
</head>
<body>
<h2>🗑️ Trash</h2>
<div style="text-align:center;"><button onclick="go('index.php')">⬅️ Back</button></div>
<?php while($m=$emails->fetch_assoc()): ?>
<div class="mail">
<b>From:</b> <?php echo $m['sender_id']; ?><br>
<b>Subject:</b> <?php echo htmlspecialchars($m['subject']); ?><br>
</div>
<?php endwhile; ?>
</body>
</html>
