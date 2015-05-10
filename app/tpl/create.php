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
    
    <h2> Creating DB </h2>
    <?php
        echo "EEE";
        $config = Registry::getInstance();
        $dbhost = $conf->dbhost;
        $dbuser = $conf->dbuser;
        $dbpass = $conf->dbpass;
        
        $conn = mysql_connect($dbhost, $dbuser, $dbpass);
        if(! $conn )
        {
          die('Could not connect: ' . mysql_error());
        }
        
        echo 'Connected successfully';
        $sql = 'CREATE Database '.$conf->dbname;
        $retval = mysql_query( $sql, $conn );
        if(! $retval )
        {
          die('Could not create database: ' . mysql_error());
        }
        echo "Database ".$conf->dbname."created successfully\n";
        mysql_select_db( $conf->dbname );
        mysql_close($conn);

        $command = "mysql -u ".$dbuser." -p ".$dbpass." -h ".$dbhost." -D ".$dbname." < app.sql";

        $output = shell_exec($command . '/shellexec.sql');
    ?>
  </section>