<div class="menubar">
<ul id="menu">
<li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],
'index.php') !== false) echo 'highlighted'; ?>"
href="index.php">Home</a></li>
<li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],
'all_packages.php') !== false) echo 'highlighted'; ?>"
href="all_packages.php">All Packages</a></li>
<li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],
'checkout.php') !== false) echo 'highlighted'; ?>"
href="checkout.php">My Account</a></li>
<li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],
'customer_register.php') !== false) echo 'highlighted'; ?>"
href="customer_register.php">Sign Up</a></li>
<li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],
'cart.php') !== false) echo 'highlighted'; ?>"
href="cart.php">Shopping Cart</a></li>
<li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],
'contact.php') !== false) echo 'highlighted'; ?>"
href="contact.php">Contact Us</a></li>
<li><a class="<?php if(strpos($_SERVER['REQUEST_URI'],
'payment.php') !== false) echo 'highlighted'; ?>"
href="payment.php">Payment</a></li>
</ul>
<div id="form">
<form method="get" action="results.php"
enctype="multipart/form-data">

<input type="text" class="search" name="user_query"

placeholder="Search all">

<input id="search" type="submit" name="search"

value="Search">
</form>
</div>
</div>