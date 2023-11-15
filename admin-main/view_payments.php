<?php
include("includes/db.php");
if (!isset($_SESSION['user_email'])) {
echo "<script>window.open('login.php?not_admin=You are not an
Admin!','_self')</script>";
} else {

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Packages</title>
<style type="text/css">
#thfix {
font-family: sans-serif;
padding: 4px;
}
</style>
</head>
<body>
<table width="795" align="center" bgcolor="#EAD2AC">
<tr align="center">

<td colspan="6"><h2 style="font-family: Cambria; margin-
top: 10px; margin-bottom: 5px;">View All

packages
Here</h2></td>

</tr>
<tr align="center" bgcolor="#5FCEE8">
<th id="thfix">index</th>
<th id="thfix">Name</th>
<th id="thfix">Paid</th>
</tr>
<?php
include("includes/db.php");
$get_pack = "select * from payments";
global $con;
$run_pack = mysqli_query($con, $get_pack);
$i = 0;
while ($row_pack = mysqli_fetch_array($run_pack)) {
$ip = $row_pack['ip'];
$name = $row_pack['name'];
$paid = $row_pack['paid'];
$i++;
?>
<tr align="center">
<td><?php echo $i; ?></td>
<td><?php echo $name; ?></td>

<td><?php echo $paid; ?></td>
<td></td>
</tr>
<?php
}
?>
</table>
</body>
</html>
<?php
}
?>