<?php include 'header.php';?>
  <div class="container">
    <form action="/ada/Controllers/controllers.php" method="post">
    <div class="row">
      <div class="col-md-4"></div>
        <div class="col-md-4">

          <!-- loggin -->
          <div class="form-outline md-4">
            <label class="form-label">Identifiant</label>
            <input type="loggin" name="loggin" class="form-control" />
          </div>
          
          <!-- Password -->
          <div class="form-outline md-4">
            <label class="form-label" >Mot de passe</label>
            <input type="password" name="password" class="form-control" />
          </div>
</br>
          <!-- Submit button -->
          <button type="submit" value="Submit" class="btn btn-secondary btn-block md-4" >Submit</button>
</br>
          <?php 
  
            if(isset($_GET['error']))
            {
              echo "Wrong";
            }
          
          ?>
        </div>
      </div>
      <div class="col-md-4"></div>
    </form>
    </div>
    <?php include 'footer.php';?>
