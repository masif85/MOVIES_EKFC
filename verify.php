<?php


setcookie('client_id', "420");
setcookie("client_id", "420", time()+3600, "/~rasmus/", "https://api.khaleejtimes.com", 1);
echo $_COOKIE['client_id'];

?>