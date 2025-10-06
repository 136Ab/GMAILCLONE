<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])) {
  echo "<script>window.location='login.php';</script>";
  exit;
}
$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];

$emails = $conn->query("SELECT * FROM emails WHERE receiver_id='$user_id' AND folder='inbox' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Gmail Clone - Dashboard</title>
<style>
body{margin:0;font-family:'Segoe UI',sans-serif;background:#f6f8fc;}
.nav{background:#fff;padding:15px 20px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
.nav h2{color:#4285f4;margin:0;}
.nav button{background:#4285f4;color:#fff;border:none;padding:8px 14px;border-radius:5px;cursor:pointer;}
.container{display:flex;}
.sidebar{width:220px;background:#fff;padding:20px;height:calc(100vh - 60px);box-shadow:2px 0 5px rgba(0,0,0,0.05);}
.sidebar button{display:block;width:100%;margin-bottom:10px;padding:10px;border:none;background:#f1f3f4;border-radius:6px;font-size:15px;cursor:pointer;text-align:left;}
.sidebar button:hover{background:#e0e0e0;}
.content{flex:1;padding:20px;}
.mail{background:#fff;margin-bottom:10px;padding:15px;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.05);}
.mail:hover{transform:scale(1.01);transition:0.2s;}
.search{margin-bottom:15px;}
.search input{width:70%;padding:10px;border:1px solid #ddd;border-radius:6px;}
</style>
<script>
function go(page){ window.location=page; }
</script>
</head>
<body>
<div class="nav">
  <h2>📧 Gmail Clone</h2>
  <div>Welcome, <?php echo htmlspecialchars($name); ?> <button onclick="go('logout.php')">Logout</button></div>
</div>
<div class="container">
  <div class="sidebar">
    <button onclick="go('compose.php')">✉️ Compose</button>
    <button onclick="go('index.php')">📥 Inbox</button>
    <button onclick="go('sent.php')">📤 Sent</button>
    <button onclick="go('drafts.php')">📝 Drafts</button>
    <button onclick="go('trash.php')">🗑️ Trash</button>
    <button onclick="go('search.php')">🔍 Search</button>
  </div>
  <div class="content">
    <div class="search">
      <input type="text" placeholder="Search email..." onkeyup="if(event.key==='Enter') go('search.php?q='+this.value)">
    </div>
    <h3>Inbox</h3>
    <?php while($mail = $emails->fetch_assoc()): ?>
      <div class="mail">
        <b>From:</b> User #<?php echo $mail['sender_id']; ?><br>
        <b>Subject:</b> <?php echo htmlspecialchars($mail['subject']); ?><br>
        <small><?php echo date('M d, Y h:i A', strtotime($mail['created_at'])); ?></small>
      </div>
    <?php endwhile; ?>
  </div>
</div>
</body>
</html>
