<?php
include('connect-db.php');

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
$id = $_GET['id'];
if ($stmt = $connect->prepare("DELETE FROM users WHERE id = ? LIMIT 1"))
{
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: could not prepare SQL statement.";
}
$connect->close();
header("Location: index.php");
}
else
{
header("Location: index.php");
}
?>