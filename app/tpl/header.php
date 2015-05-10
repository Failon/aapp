<body>        
    <header>
          <div class="header-tit">
            <div id="wrapper">
            <a href="<?= APP_W; ?>"><img class="logo" alt="Put your logo" src="<?= APP_W.'pub/theme/k/'.$logo;?>"/></a>
            <h1><?= $titol;?></h1>
            </div>
          </div>
              <div class="regist">
              <?php if(!isset($_SESSION['usuario'])){
                $button = 'Entrar';
                $route = APP_W.'home/login';
              ?>
                <form class="reg" name="formlog" method="post" action="<?= $route?>">
                    <label for="email">Email<input type="text" name="email" value="" placeholder="youremail@example.com" required></label>
                    <label for="password">Password<input type="password" name="password" placeholder="password" required></label>
                    <input type="submit" class="bEntra" value="<?= $button ?>" id="logsend">
                </form>
                <p>or click <a href="<?=APP_W;?>reg">here</a> to register with our site</p>
              <?php }else{
                $button = 'Sortir';
                $route = APP_W.'home/logout';
              ?>
                <form class="logout" action="<?= $route?>" method="post">
                <h2>Benvingut, <?= $_SESSION['usuario']?></h2>
                <input type="submit" value="<?= $button?>" class="bEntra" id="logsend">
                </form>
                
                <label for="profile">Update your Profile<a href="<?=APP_W;?>profile"><img id="profile_update" src="<?=APP_W;?>pub/theme/k/img/profile.png" alt="profile_update"></a></label>
               <?php 
               if($_SESSION['admin']==1){
               ?>
               <label for="admincp">admin cp<a href="<?=APP_W;?>admin"><img src="<?=APP_W;?>pub/theme/k/img/admin.png" alt="admincp"></a></label>
               <?php }} ?>
              </div>
  </header>