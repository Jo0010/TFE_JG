<?php

class Images
{
    private $id_img;
    private $name;
    private $path;
    private $id_project;


    public function getPath()
    {
        return $this->path;
    }

  
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    
    public function getName()
    {
        return $this->name;
    }

   
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

   
    public function getId_img()
    {
        return $this->id_img;
    }

    
    public function setId_img($id_img)
    {
        $this->id_img = $id_img;

        return $this;
    }

    public function getId_project()
    {
        return $this->id_project;
    }
    function connection()
    {
        try 
        {
            $db = new PDO('mysql:host=localhost;dbname=ada;charset=utf8','root','');
            return $db;
        } 
        catch (Exception $erro) 
        {
            die('Erreur:'.$erro->getMessage());
        }
    }

    
    public function setId_project($id_project)
    {
        $this->id_project = $id_project;

        return $this;
    }

    function checkName($name)
    {
        $tabImg=$this->getAllImgs();
        for($i=0;$i<count($tabImg);$i++)
        {
            if($name==$tabImg[$i][1])
            {
                return true;
            }
        }
        return false;
    }
    function addimage($image)
    {
        $db = $this->connection();
        $sqlQuery = 'INSERT INTO images(name,path,id_project) VALUE (:name,:path,:id_project)';
        $insertImage = $db->prepare($sqlQuery);
        $insertImage->execute([
            'name'=> $image->getName(),
            'path'=> $image->getPath(),
            'id_project'=> $image->getId_project(),
        ]);
    }

    /* retourne les images liee au projet */
    function imageProject ($id_project)
    {
        $db = $this->connection();
        $sqlQuery = 'SELECT * FROM images WHERE id_project=?';
        $imgStat = $db->prepare($sqlQuery);
        $imgStat->execute([$id_project]);
        $tabImg = $imgStat->fetchAll();

        return $tabImg;
        
    }
    function getAllpathProject($id_project)
    {
        $db = $this->connection();
        $sqlQuery = 'SELECT path FROM images WHERE id_project=?';
        $imgStat = $db->prepare($sqlQuery);
        $imgStat->execute([$id_project]);
        $tabImg = $imgStat->fetchAll(PDO::FETCH_COLUMN);
        return $tabImg;
    }
    /* retourner les id des images d un projet */
    function getAllIdProject($id_project)
    {
        $db = $this->connection();
        $sqlQuery = 'SELECT id_img FROM images WHERE id_project=?';
        $imgStat = $db->prepare($sqlQuery);
        $imgStat->execute([$id_project]);
        $tabImg = $imgStat->fetchAll(PDO::FETCH_COLUMN);
        return $tabImg;
    }
    function deleteImg($id_img)
    {
        $db = $this->connection();
        $deleteImg = $db->prepare('DELETE FROM images WHERE id_img=:id_img');
        $deleteImg->bindParam(':id_img', $id_img, PDO::PARAM_INT);
        $deleteImg->execute() or die(print_r($db->errorInfo()));
    }
    /* effacer toutes les images d un projet */
    function deleteAllImg($id_project)
    {
        $db = $this->connection();

        $deleteAllImg = $db->prepare('DELETE FROM images WHERE id_project = :id_project');
        $deleteAllImg->bindParam(':id_project', $id_project, PDO::PARAM_INT);
        $deleteAllImg->execute() or die(print_r($db->errorInfo()));
    }

    function getAllImgs()
    {
        $db = $this->connection();
        $sqlQuery = 'SELECT * FROM images';
        $imgStat = $db->prepare($sqlQuery);
        $imgStat->execute();
        $tabImg = $imgStat->fetchAll();

        return $tabImg;
    }

    /* retourner id d une image depuis son nom */
    function getIdFromName($name)
    {
        $db = $this->connection();
        $sqlQuery = 'SELECT id_img FROM images WHERE name=?';
        $imgStat = $db->prepare($sqlQuery);
        $imgStat->execute([$name]);
        $tabImg = $imgStat->fetchAll(PDO::FETCH_COLUMN);
        return $tabImg;
   
    }

    /* retourner le nom d une image depuis son id */
    function getNamefromId($id_img)
    {
        $db = $this->connection();
        $sqlQuery = 'SELECT name FROM images WHERE id_img=?';
        $imgStat = $db->prepare($sqlQuery);
        $imgStat->execute([$id_img]);
        $tabImg = $imgStat->fetchAll(PDO::FETCH_COLUMN);
        return $tabImg;

    }

}
?>