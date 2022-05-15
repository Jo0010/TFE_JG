<?php
require_once '../Models/Project.php';
require_once '../Models/Images.php';
require_once '../Models/Admin.php';

$tabError= array();

$img = new Images();
$project = new Project();

$allProjId=$project->getAllId();
$bigestId=$project->getBigId();

$allProj=$project->getAllProjects();


if(isset($_GET['gallery']))
{
    
    header("location:../View/gallery.php");
}
if(isset($_GET['deleteProj']))
{
    $im= new Images();
    $pro= new Project();
    $im->deleteAllImg($_GET['proj']);
    $pro->deleteProject($_GET['proj']);
    header("location:../View/gallery.php");
}

if(isset($_GET['imagesup']))
{
    $name=$img->getIdFromName($_GET['imagesup']);
    $img->deleteImg($name[0]);
    header("location:../View/gallery.php");
}

if(isset($_POST['addProject']))
{  
    $proj = new Project();
    $proj->setDescription($_POST['projDesc']);
    $proj->setId_project(0);
    $proj->addProject($proj);
    header("location:../View/gallery.php");
}
if(isset($_GET['newDesc']))
{    
    $project->edditProject($_GET['newDesc'],$_GET['idp']);
    /* var_dump($_GET['newDesc']);
    var_dump($_GET['idp']); */
    header("location:../View/gallery.php");
}
/* ajout d'image */

if(isset($_POST["submit"])) {
    
    $countfiles = count($_FILES["fileToUpload"]["name"]);
    for($i=0;$i<$countfiles;$i++){

        $target_dir = "../View/images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $pf=basename($_FILES["fileToUpload"]["name"][$i]);
        $nf=basename($_FILES["fileToUpload"]["name"][$i],$imageFileType);
        $mg = new Images();
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
            if($check !== false) {
               
                $uploadOk = 1;
            } else {
                $error.= "File is not an image.";
                $uploadOk = 0;
               /*  header("location:../View/gallery.php?error6"); */
            }
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            $error.="Sorry, file already exists.";
            $uploadOk = 0;
           /*  header("location:../View/gallery.php?error1"); */
        }
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"][$i] > 500000) {
            $error.= "Sorry, your file is too large.";
            $uploadOk = 0;
           /*  header("location:../View/gallery.php?error2"); */
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $error.= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
            /* header("location:../View/gallery.php?error3"); */
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error.= "<br> Sorry, your file was not uploaded.";
           /*  header("location:../View/gallery.php?error=$error4"); */
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
                $ok= "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " has been uploaded.";
                $mg->setName($nf);
                $mg->setPath($pf);
                $mg->setId_project($_POST['idp']);
              
                 $mg->addimage($mg); 
                header("location:../View/gallery.php"); 

            } else {
                $error.= "Sorry, there was an error uploading your file.";
               /*  header("location:../View/gallery.php?error5"); */
            }
        }
        /* header("location:../View/gallery.php?error=$error"); */
    }
    
}


?>