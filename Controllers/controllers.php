<?php
require_once '../Models/Admin.php';

session_start();

$wrong = false;

/* connection */
if((isset($_POST["loggin"]))&&(isset($_POST["password"])))
{
    $nom= new Admin();
    $_SESSION["administrator"]= false;

    if($nom->authentification($_POST["loggin"],password_hash($_POST["password"], PASSWORD_BCRYPT)))
    {
        $nom->setLogin($_POST["loggin"]);
        $nom->setMdp(password_hash($_POST["password"], PASSWORD_BCRYPT));
        $_SESSION["administrator"]= true;
        header("location:../View/home.php"); 
    }
    else{   
        header("location:../View/login.php?error");  
    } 
    
}
/* deconnection */
if(isset($_GET['logout']))
{
    $adm = new Admin();
    $adm->logoutSes();
    header("location:../View/home.php");
}

/* redirection */
if(isset($_GET['contact']))
{
    header("location:../View/contact.php");
}

/* redirection */
if(isset($_GET['home']))
{
    header("location:../View/home.php");
}

/* redirection */
if(isset($_GET['apropos']))
{
    header("location:../View/apropos.php");
}

?>