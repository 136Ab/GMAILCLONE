<?php
include 'db.php';
session_start();

if(!isset($_SESSION['user_id'])){
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM emails WHERE receiver_id='$user_id' AND folder='drafts' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Drafts - Gmail Clone</title>
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f1f3f4;
    margin: 0;
    padding: 0;
}
.header {
    background: #d93025;
    color: white;
    padding: 15px 30px;
    font-size: 22px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.header button {
    background: white;
    color: #d93025;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}
.header button:hover {
    background: #ffe1df;
}
.container {
    margin: 25px auto;
    width: 90%;
    max-width: 1000px;
    background: white;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
}
.email-header {
    display: grid;
    grid-template-columns: 30% 50% 20%;
    background: #f8f9fa;
    font-weight: bold;
    padding: 12px;
    border-bottom: 1px solid #ddd;
}
.email-item {
    display: grid;
    grid-template-columns: 30% 50% 20%;
    padding: 10px 12px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: 0.2s;
}
.email-item:hover {
    background: #f6f6f6;
}
.no-drafts {
    text-align: center;
    padding: 30px;
    color: #777;
}
.back-btn {
    margin: 20px 0 0 5%;
    padding: 10px 20px;
    background: #d93025;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}
.back-btn:hover {
    background: #b71c1c;
}
</style>
</head>
<body>
<div class="header">
    <div>📨 Drafts</div>
    <button onclick="redirectTo('compose.php')">+ Compose</button>
</div>

<div class="container">
    <div class="email-header">
        <div>To</div>
        <div>Subject</div>
        <div>Date</div>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="email-item" onclick="viewDraft(<?php echo $row['id']; ?>)">
                <div><?php echo htmlspecialchars($row['receiver_email']); ?></div>
                <div><?php echo htmlspecialchars($row['subject']); ?></div>
                <div><?php echo htmlspecialchars($row['created_at']); ?></div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="no-drafts">No drafts saved yet ✉️</div>
    <?php endif; ?>
</div>

<button class="back-btn" onclick="redirectTo('index.php')">← Back to Inbox</button>

<script>
function redirectTo(page) {
    window.location.href = page;
}
function viewDraft(id){
    window.location.href = "view_draft.php?id=" + id;
}
</script>
</body>
</html>
