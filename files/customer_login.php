<?php
include("db.php");
?>
<?php
global $con;
$c_email = $c_pass = "";
if (isset($_POST['login'])) {

$c_email = $_POST['email'];
$c_pass = $_POST['pass'];
// fetching email id which equals to email of user input
$sel_c = "select * from customers where
customer_email='$c_email'";
$run_c = mysqli_query($con, $sel_c);
$check_customer = mysqli_num_rows($run_c);
if($check_customer > 0){
$row = mysqli_fetch_assoc($run_c);
$_SESSION['customer_email'] = $c_email;
$ip = getIp();
$sel_cart = "select * from cart where ip_add='$ip'";

// we have used hashsing to store password so we r verifying password with hash value.
if(password_verify($c_pass, $row['customer_pass'])){
$run_cart = mysqli_query($con, $sel_cart);
$check_cart = mysqli_num_rows($run_cart);

if ($check_customer > 0 and $check_cart == 0) {
$_SESSION['customer_email'] = $c_email;
echo "<script>alert('You have logged in successfully.

Thanks!')</script>";
echo

"<script>window.open('index.php','_self')</script>";

} else {
$_SESSION['customer_email'] = $c_email;
echo "<script>alert('You have logged in successfully.

Thanks!')</script>";
echo

"<script>window.open('checkout.php','_self')</script>";

}
}
else

$err="invalid credentials";

}
else {
$err= "Invalid credentials; ";
}

$ip = getIp();
}
?>
<style type="text/css">
#fixtd {
margin-top: 15px;
}
#inputbox {
margin-top: 5px;
font-family: arial;
font-size: 15px;
}
#btn {
margin-top: 15px;
margin-bottom: 15px;
font-size: 18px;
margin-bottom: 20px;
font-weight: bolder;
background-color: #4CAF50; /* Green */
border: none;
color: white;
padding: 13px 20px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin: 4px 2px;
cursor: pointer;
-webkit-transition-duration: 0.4s; /* Safari */
transition-duration: 0.4s;
}

#btn:hover {
box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0
rgba(0, 0, 0, 0.19);
}
#fp {
margin-top: 10px;
}
</style>
<div>
<form action="" method="post">
<table width="500px" align="center" style="border-radius:
10px; padding: 25px 15px;" bgcolor="skyblue">

<tr align="center">
<td colspan="3">
<h2 style="margin-top: 20px; margin-bottom: 15px;

font-family: Cambria;">Login or Register to
Buy!</h2>

</td>
</tr>
<tr>
<td align="right"><b style="font-size: 17px; padding:

5px;">Email:</b></td>

<td><input id="inputbox" type="text" style="padding:
10px; border-radius: 10px;" name="email" value="<?php $c_email?>"
placeholder="Enter your email" required=""></td>

</tr>
<tr>
<td align="right"><b style="font-size:

17px;">Password:</b></td>

<td><input id="inputbox" type="password" name="pass"
style="margin-top: 25px;padding: 10px; border-radius: 10px;"
value="<?php $c_pass?>" placeholder="Enter your password"
required=""></td>
</tr>
<tr align="center">
<td colspan="3"><input id="btn" type="submit"

name="login" value="Login"></td>

<br>
</tr>
<tr>
<td colspan="3"><h2 style=" padding: 0 25px 10px 0;

margin: 15px"><a href="customer_register.php" style="text-decoration:

none;">New? Register Here</a>

</h2></td>
</tr>
</table>
</form>

</div>