<body>        
    <header>
          <div class="header-tit">
            <div id="wrapper">
            <a href="<?= APP_W; ?>"><img class="logo" alt="Put your logo" src="<?= APP_W.'pub/theme/k/'.$logo;?>"/></a>
            <h1><?= $titol;?></h1>
            </div>
          </div> <!-- from div header-tit -->
          </header>
          <section>
    <h1>KFrramwork</h1>
    <h2>App installer v1.0</h1>
    <h2> Setting DB</h2>
    <form id="instal" method="post" action=<?= APP_W.'install/create' ;?>>
      <label for="database">Database name?<input type="text" required name="dbname"></label><br>
      <input type="submit" value="Continue">
      <label></label>
    </form>
  </section>