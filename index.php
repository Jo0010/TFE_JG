<?php 
if (isset($_GET['page'])) {
$requested_page = $_GET['page'];
}
else {
$requested_page = 'home';
}
// a better way would be to put this into an array, but I think a switch is easier to read for this example
switch($requested_page) {
   case "home":
      include(__DIR__."/View/home.php");
      break;
   case "gallery":
      include(__DIR__."/View/gallery.php");
      break;
   case "login":
      include(__DIR__."/View/login.php");
      break;
   case "apropos":
      include(__DIR__."/View/apropos.php");
      break;
   case "contact":
      include(__DIR__."/View/contact.php");
      break;
   default:
      include(__DIR__."/View/home.php");
}