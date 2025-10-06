v<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])){echo "<script>window.location='login.php';</script>";exit;}
$q = isset($_GET['q']) ? $_GET['q'] : '';
$uid = $_SESSION['user_id'];
$sql = "SELECT * FROM emails WHERE receiver_id='$uid' AND (subject LIKE '%$q%' OR body LIKE '%$q%')";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Search Emails</title>
<style>
body{font-family:'Segoe UI';background:#f6f8fc;}
.mail{background:#fff;margin:10px auto;width:80%;padding:15px;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
.mail:hover{transform:scale(1.01);transition:0.2s;}
h2{text-align:center;color:#4285f4;}
input{display:block;margin:0 auto;width:60%;padding:10px;border:1px solid #ddd;border-radius:6px;}
button{background:#4285f4;color:white;border:none;padding:10px 20px;border-radius:6px;cursor:pointer;}
</style>
<script>function go(p){window.location=p;}</script>
</head>
<body>
<h2>🔍 Search Emails</h2>
<form method="get" style="text-align:center;">
<input type="text" name="q" placeholder="Enter subject or content" value="<?php echo htmlspecialchars($q); ?>">
<button type="submit">Search</button>
<button type="button" onclick="go('index.php')">Back</button>
</form>
<?php while($m=$res->fetch_assoc()): ?>
<div class="mail">
<b>From:</b> User #<?php echo $m['sender_id']; ?><br>
<b>Subject:</b> <?php echo htmlspecialchars($m['subject']); ?><br>
<p><?php echo nl2br(htmlspecialchars($m['body'])); ?></p>
</div>
<?php endwhile; ?>
</body>
</html>
