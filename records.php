<?php
include("connect-db.php");

function renderForm($first = '', $last ='',$idcard = '', $error = '', $id = '')
{ 
?>
<html>
<head>
<title>
<?php if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?>
<style>
table {
	text-align: center;
}
</style>
</title>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript"> 
$(function(){
    $("input[name^='idcard_']").keyup(function(event){
        if(event.keyCode==8){
            if($(this).val().length==0){
                $(this).prev("input").focus();  
            }
            return false;
        }           
        if($(this).val().length==$(this).attr("maxLength")){
            $(this).next("input").focus();
        }
    }); 
});
</script>
</head>
<body>
<form action="" method="post">
  <div>
    <table width="50%" border="0" align="center">
      <tr>
        <td><h1>
            <?php if ($id != '') { echo "Edit Record"; } else { echo "Add Record"; } ?>
          </h1>
          <?php if ($error != '') { echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error. "</div>"; } ?></td>
      </tr>
      <tr>
        <td><?php if ($id != '') { ?>
          <input type="hidden" name="id" value="<?php echo $id; ?>" />
          <p>ID: <?php echo $id; ?></p>
          <?php } ?></td>
        <td></td>
      </tr>
      <tr>
        <td><strong>First Name: </strong></td>
        <td><input type="text" name="firstname" value="<?php echo $first; ?>"/ maxlength="50"></td>
      </tr>
      <tr>
        <td><strong>Last Name: </strong></td>
        <td><input type="text" name="lastname" value="<?php echo $last; ?>"/ maxlength="50"></td>
      </tr>
      <tr>
        <td><strong>ID-Personal: </strong></td>
        <td><input type="text" name="idcard" value="<?php echo $idcard; ?>"/ maxlength="13"></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Submit" /></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
<?php }


/////////////////////////////////////////////// EDIT RECORD
if (isset($_GET['id']))
{
if (isset($_POST['submit']))
{
if (is_numeric($_POST['id']))
{

$id = $_POST['id'];
$firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
$lastname = htmlentities($_POST['lastname'], ENT_QUOTES);
$idcard = htmlentities($_POST['idcard'], ENT_QUOTES);

if ($firstname == '' || $lastname == '' || $idcard == '')
{
$error = 'ERROR: Please fill in all required fields!';
renderForm($firstname, $lastname, $idcard, $error, $id);
}
else{
	if ($stmt = $connect->prepare("UPDATE users SET firstname = ?, lastname = ?, idcard = ? WHERE id=?")){
	$stmt->bind_param("sssi", $firstname, $lastname, $idcard, $id);
	$stmt->execute();
	$stmt->close();
	}else{
		echo "ERROR: could not prepare SQL statement.";
		}

header("Location: index.php");
}
}
else
{
echo "Error!";
}
}
else
{
if (is_numeric($_GET['id']) && $_GET['id'] && $_GET['id'] > 0)
{
$id = $_GET['id'];

if($stmt = $connect->prepare("SELECT * FROM users WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($id, $firstname, $lastname, $idcard);
$stmt->fetch();

renderForm($firstname, $lastname, $idcard, NULL, $id);

$stmt->close();
}
else
{
echo "Error: could not prepare SQL statement";
}
}
else
{
header("Location: index.php");
}
}
}


/////////////////////////////////////////////// ADD RECORD
else
{
if (isset($_POST['submit']))
{
$firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
$lastname = htmlentities($_POST['lastname'], ENT_QUOTES);
$idcard = htmlentities($_POST['idcard'], ENT_QUOTES);

if ($firstname == '' || $lastname == '' || $idcard == '')
{
$error = 'ERROR: Please fill in all required fields!';
renderForm($firstname, $lastname, $idcard, $error);
}
else
{
if ($stmt = $connect->prepare("INSERT users (firstname, lastname, idcard) VALUES (?, ?, ?)"))
{
$stmt->bind_param("sss", $firstname, $lastname, $idcard);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: Could not prepare SQL statement.";
}

header("Location: index.php");
}

}
else
{
renderForm();
}
}
$connect->close();
?>