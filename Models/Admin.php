<?php

class Admin {
    private $login;
    private $mdp;
    private $email;

    public function getLogin()
    {
        return $this->login;
    }

    
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

   
    public function getMdp()
    {
        return $this->mdp;
    }

    
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    
    public function getEmail()
    {
        return $this->email;
    }

    
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function connection()
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

    public function logoutSes()
    {
        $_SESSION['administrator']=false;

    }

    public function authentification($log,$mdp)
    {
        
        $donne = $this->connection();
        $sqlQuery = 'SELECT * FROM admins';
        $adminStat = $donne->prepare($sqlQuery);
        $adminStat->execute();
        $tabAdmin = $adminStat->fetchAll();
        
        foreach ($tabAdmin as $key => $value) {
            $hash = password_hash($value['mdp'], PASSWORD_BCRYPT);
            if (($value['login']==$log)&&(password_verify($value['mdp'],$hash))){
                return true;
            }
        }
        return false;
    }
    function edditAdmin($admin)
    {
        $mysqlClient = $this->connection();
        $adminStat = $mysqlClient->prepare('UPDATE admins SET login = :login, mdp = :mdp, email = :email where id_admin=:id');
        $adminStat->execute([
            'id'=> "1",
            'login'=> $admin->getLogin(),
            'mdp'=> $admin->getMdp(),
            'email'=> $admin->getEmail(),
        ]);
    }

    function getAllAdmin()
    {
        $db = $this->connection();

        $sqlQuery = 'SELECT * FROM admins';
        $admin = $db->prepare($sqlQuery);
        $admin->execute();
        $tabAdmin = $admin->fetchAll();

        return $tabAdmin;
    }

}


?>