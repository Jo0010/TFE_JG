<?php
require_once '../Models/Project.php';


    /*var_dump($_POST["text"]);
    $proj = new Project();
    $proj->setDescription($_POST["text"]);
    $proj->addProject($proj);

    $proj = new Project();
    $big=$proj->getBigId();
*/
echo "0";
if(isset($_POST['submit'])){
    echo "1";
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmpname'];
    $fileName = $_FILES['file']['size'];
    $fileName = $_FILES['file']['error'];
    $fileName = $_FILES['file']['type'];

    $fileExt= explode('.',$fileName);
    $fileActualExt=strtolower(end($fileExt));
    $allowed= array('jpg','jpeg','png');
    if(in_array($fileActualExt,$allowed))
    {
        echo "2";
        if($fileError=== 0)
        {
            if($filesize < 500000)
            {
                $fileNameNew=uniquid('',true).".".$fileActualExt;
                $fileDestination= '/ADA/View/images/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);

            }
            else{
                echo "error file too big";
            }
        }else{
            echo "uploading error";
        }

    }else{
        echo "errror";
    }

    
}


?>