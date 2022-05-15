<?php
class Project {
    private $id_project;
    private $description;


    public function getId_project()
    {
        return $this->id_project;
    }

   
    public function setId_project($id_project)
    {
        $this->id_project = $id_project;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

   
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
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

    function addProject($project)
    {
        $db = $this->connection();
        $sqlQuery = 'INSERT INTO projects(description) VALUE (:description)';
        $insertProject = $db->prepare($sqlQuery);
        $insertProject->execute([
            'description'=> $project->getDescription(),
        ]);
      
        
    }
    function edditProject($description,$id_project)
    {
        $mysqlClient = $this->connection();
        $stmt = $mysqlClient->prepare("UPDATE projects SET description = :description WHERE id_project=:id_project");
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':id_project',$id_project);
        $stmt->execute();
    }
    
    function deleteProject($id_project)
    {
        $db = $this->connection();
        $deleteProj = $db->prepare('DELETE FROM projects WHERE id_project=:id_project');
        $deleteProj->bindParam(':id_project', $id_project, PDO::PARAM_INT);
        $deleteProj->execute() or die(print_r($db->errorInfo()));
    }

    function getAllProjects()
    {
        $db = $this->connection();

        $sqlQuery = 'SELECT * FROM projects';
        $projectStat = $db->prepare($sqlQuery);
        $projectStat->execute();
        $tabProject = $projectStat->fetchAll();

        return $tabProject;
    }

    function getBigId()
    {
        $db = $this->connection();
        $sqlQuery = 'SELECT MAX(id_project) AS maxId FROM projects';
        $projectStat = $db->prepare($sqlQuery);
        $projectStat->execute();
        $bigTab=$projectStat->fetch(PDO::FETCH_ASSOC);
        return $bigTab['maxId'];

    }

    function getAllId()
    {
        $db = $this->connection();
        $sqlQuery = 'SELECT id_project FROM projects';
        $projectStat = $db->prepare($sqlQuery);
        $projectStat->execute();
        $tabId = $projectStat->fetchAll(PDO::FETCH_COLUMN);
        return $tabId;
    }

    function descFromId($idp)
    {
        $db = $this->connection();
        $sqlQuery = 'SELECT description FROM projects WHERE id_project=?';
        $desc = $db->prepare($sqlQuery);
        $desc->execute([$idp]);
        $tabDesc = $desc->fetchAll(PDO::FETCH_COLUMN);
        return $tabDesc;
    }
   /*  function addimage($_FILES)
    {
        if ((isset($_FILES['img']))&& ($_FILES['img']['error']==0)) 
        {
            if($_FILES['img']['size']<=1000000)
            {
                $fileInfo = pathinfo($_FILES['img']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['jpg','jpeg','gif','png'];
                if (in_array($extension, $allowedExtensions))
                {
                     
                }
            }
        }
    } */


}
?>