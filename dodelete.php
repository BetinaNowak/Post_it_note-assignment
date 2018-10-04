<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <title>delete note</title>

</head>
<body>

<?php session_start(); ?>
<?php
if(isset($_SESSION['userid'])){
  $postitid = filter_input(INPUT_POST, 'pid', FILTER_VALIDATE_INT) or die('Missing');
  $userid = $_SESSION['userid'];

    require_once('dbcon.php');

    $sql = 'DELETE FROM postit WHERE id=? and users_id=?';
    $stmt = $link->prepare($sql);
    $stmt->bind_param('ii', $postitid, $userid);
    $stmt->execute();
    header('Location: index.php');
    exit();
}
     ?>


</body>
</html>
