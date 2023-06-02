<?php
if(isset($_POST['announcement'])) {
  $announcement = $_POST['announcement'];
  file_put_contents("announcement.txt", $announcement);
}
header("Location: adminpage.php");
exit;
?>