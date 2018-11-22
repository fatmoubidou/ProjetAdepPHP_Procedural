<?php
//We load the files we need
require "modele/db.php";
require "modele/userManager.php";
require "service/sessionManager.php";
require "service/formChecker.php";

//We check if the form has been filled
if(!empty($_POST)) {
  //We clean form entries
  $_POST = clearForm($_POST);
  //We retrieve user stocked on the website
  $user = getUser($_POST["email"], $db);
  //We check if db has found user
  if(!empty($user) && $_POST["password"] === $user["password"]) {
    initializeUserSession($user);
    header("Location: emprunts.php");
    //We put exit to stop execution of the script, otherwise redirection won't have time to execute
    exit;
  }
  else {
    header("Location: index.php?message=7");
    exit;
  }
}
//If the form is not filled we redirect user on login page with error message
else {
  header("Location: index.php?message=0");
  exit;
}

 ?>
