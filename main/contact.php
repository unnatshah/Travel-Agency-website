<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-
scale=1.0">

<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Contact Us</title>
<link rel="stylesheet" href="styles/style.css" media="all">
<style>
#guides {
font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
border-collapse: collapse;
width: 800px;
font-size: 17px;
}

#guides th {
text-align: left;
background-color: #3A6070;
color: #fff;
padding: 5px 10px;
}
#guides td {
padding: 5px 10px;
text-align: left;
}
#guides tr:nth-child(odd) td {
background-color: lightcoral;
}
#regoff {
font-size: 15px;
}
#headoff {
font-size: 16px;
}
</style>

</head>
<body>
<div class="main_wrapper">
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/header.php'; ?>
<div class="content_wrapper">
<div class="sidebar">
<div id="sidebar_title"><b>Contact Us</b></div>
<br><br><br><br><br><br><br>
<div id="sidebar_title"><b>24/7 Hotline</b></div>
<div id="sidebar_title"><b>Dial: 16505</b></div>
</div>
<div id="content_area">
<div id="packages_box">
<br>
<h2>Our Local Guides</h2>
<br>

<table id="guides" align="center" style="border-
radius: 10px;" bgcolor="#6495ed">

<tr align="center" bgcolor="#db7093">
<th id="thfix">Name</th>
<th id="thfix">Email</th>
<th id="thfix">Location</th>
<th id="thfix">Address</th>
<th id="thfix">Contact</th>
</tr>
<?php
include("includes/db.php");
$get_c = "SELECT * FROM employees";
$run_c = mysqli_query($con, $get_c);
$i = 0;
while ($row_c = mysqli_fetch_array($run_c)) {
$e_id = $row_c['emp_id'];
$e_name = $row_c['emp_name'];
$e_email = $row_c['emp_email'];
$e_designation =

$row_c['emp_designation'];

$e_location = $row_c['emp_location'];
$e_address = $row_c['emp_address'];

$e_contact = $row_c['emp_contact'];
$i++;
?>
<tr align="left">
<td style="width: 150px;"><?php echo

$e_name; ?></td>

<td style="width: 160px;"><?php echo

$e_email; ?></td>

<td style="width: 100px;"><?php echo

$e_location; ?></td>

<td style="width: 240px;"

align="center"><?php echo $e_address; ?></td>

<td style="width: 120px;"><?php echo

$e_contact; ?></td>
</tr>
<?php
}
?>
</table>
<br><br><br>
<h3 style="font-family: Cambria;">Head

Office:</h3>

<p id="headoff"><b>Address: </b>Gandhinagar,

Gujarat.<br>

<b>Contact: </b>1234506789
</p>
<br>
</div>
</div>
</div>
</div>
</body>
</html>