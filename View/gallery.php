<?php 
include 'header.php';
include '../Controllers/controllerProject.php';
?>
<style>
    
   
    
  </style>
<div class="container_gallery">
  <div class="rows">
    <?php
      
      if(isset($_GET['error']))
      {
        echo $_GET['error'];
      }
    ?>
  </div>
    </br>
  <div class="row">
    <?php
      if($_SESSION['administrator'])
      {
    ?>
    <form action='/ada/Controllers/controllerProject.php' method='post'>
     <label for="project"><h4>Ajouter un projet</h4> </label>
       <div class="mb-3 mt-3">
         <label for="comment">Description:</label>
         <textarea class="form-control" rows="5" id="comment" name="projDesc"></textarea>
      </div>
        <input type="submit" class="btn btn-secondary" value="Nouveau projet" name="addProject" >
      
    </form>
       <?php 
      }
    ?>
  </div>
  </br>
  <div class="row">
    <?php 
    $g=0;
    foreach($allProjId as $idProj)
    {
      $tabImg=$img->getAllIdProject($idProj[0]);
      for($b=0;$b<count($tabImg);$b++)
      {
        $tabName[$b]=$img->getNamefromId($tabImg[$b]);
      }
      
      $allImgFromProject=$img->getAllpathProject($idProj);
      ?>
        <!-- Carousel -->
      <div id="gallery<?php echo "$g"; ?>" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
      <?php
      for($a=0;$a<=count($allImgFromProject)-1;$a++)
      {
        ?>
        
          
            <?php
            if($a==0)
            {?>
              <div class="carousel-item active">
                <img src="/ada/View/images/<?php echo $allImgFromProject[0]; ?>" alt="img" class="mx-auto d-block" >
              </div>
            <?php 
            }
            else{
              ?>
                <div class="carousel-item">
                  <img src="/ada/View/images/<?php echo $allImgFromProject[$a]; ?>" alt="img" class="mx-auto d-block" >
                </div>
              <?php
            }
            ?>
      <?php
      }
      ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#gallery<?php echo "$g"; ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#gallery<?php echo "$g"; ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
      </div>
      <?php
      if($_SESSION['administrator'])
      {
    ?>
   </div>
    </br>
     
    <div class="container_description">
    <div class="row">
      
      <!-- ajouetr image -->
      <form action='/ada/Controllers/controllerProject.php' method='post' enctype='multipart/form-data'>
        Selectionner les images:
        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
        <input id="idp" name="idp" type="hidden" value="<?php echo $idProj[0]; ?>">
        <input type="submit" class="btn btn-secondary" value="Ajouter des images" name="submit">
      </form>
      </div>
    </br>
      <div class="row">
      <!-- supprimer image -->
        <form action="/ada/Controllers/controllerProject.php" method="GET">
          <label for="sel1" class="form-label">Choisir l'image à supprimer:</label>
          <select class="form-select" id="sel1" name="imagesup">
          <?php 
            for($v=0;$v<count($tabName);$v++)
            {
            ?>
            <option><?php echo $tabName[$v][0]; ?></option>
           
            <?php
            }
            ?>
          </select>
          <button type="submit" class="btn btn-danger mt-3">Supprimer</button>
        </form>  
        </div>
    <?php 
      }
    ?>
    </br>
      <div class="row">
        <p>
          <?php
          $ds=$project->descFromId($idProj);
          echo $ds[0];
          ?>
        </p>
      </div>
      <?php
      if($_SESSION['administrator'])
      {
      ?>
      </br>
      <div class="row">

      <form action="/ada/Controllers/controllerProject.php">
        <div class="mb-3 mt-3">
          <label for="comment">Description:</label>
          <textarea class="form-control" rows="5" id="comment" name="newDesc"></textarea>
        </div>
        <input id="idp" name="idp" type="hidden" value="<?php echo $idProj[0]; ?>">
        <button type="submit" class="btn btn-secondary">Valider</button>
      </form>
    </div>
      </br>
    <div class="row">      
        <!-- supprimer projet -->
        <a href="/ada/Controllers/controllerProject.php?deleteProj&proj=<?php echo $idProj[0]; ?>" class="btn btn-danger">supprimer un projet</a>        
      <?php 
        }
      ?>
      </div>
      <?php
      $g++;
    }
    ?>
  </div>
  </div>
  
</div>
<?php include 'footer.php';?>