<?php
	include("connect-db.php");
	include("sortcolumn.php");
	
	$sql = "SELECT * from users ORDER BY " . $orderBy . " " . $order;
	$result = mysqli_query($connect,$sql);
?>
<html>
<head>
<style>
td {
	border: 1px solid black;
}
th {
	background-color: #FFC;
}
</style>
</head>
<body >
<div align="center" style="width:100%">
  <?php if(!empty($result)) { ?>
  <table border="0" cellpadding="5" cellspacing="1" style="width:50%">
    <thead>
      <tr>
        <th><a href="?orderby=firstname&order=<?php echo $firstname; ?>" class="column-title">First Name</a></th>
        <th><a href="?orderby=lastname&order=<?php echo $lastname; ?>" class="column-title">Last Name</a></th>
        <th><a href="?orderby=idcard&order=<?php echo $idcard; ?>" class="column-title">ID-Personal</a></th>
        <th></th>
        <th align="right"><a href="records.php"><img src="ImgBT/+.png" width="20" height="20" alt="Add"> ADD</a></th>
      </tr>
    </thead>
    <?php while($row = mysqli_fetch_array($result)) { ?>
    <tbody>
      <tr>
        <td><?php echo $row["firstname"]; ?></td>
        <td><?php echo $row["lastname"]; ?></td>
        <td><?php echo $row["idcard"]; ?></td>
        <td><a href='records.php?id=<?php echo $row["id"]; ?>'><img src="ImgBT/Editor.png" width="20" height="20" alt="Edit"> Edit </a></td>
        <td><a href='delete.php?id=<?php echo $row["id"]; ?>'><img src="ImgBT/Delete.png" width="50" height="20" alt="Delete"> Delete </a></td>
      </tr>
    <tbody>
      <?php } ?>
  </table>
  <?php } ?>
  </form>
</div>
</body>
</html>
