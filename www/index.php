<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LAMP STACK</title>
        <link rel="stylesheet" href="/assets/css/bulma.min.css">
    </head>
    <style type="text/css">
      .hero.is-info.is-bold {
          background-image: url(../assets/img/bg), linear-gradient(141deg,#04a6d7 0,#209cee 71%,#3287f5 100%);
          background-repeat: no-repeat;
          background-position: right bottom;
          background-size: 20%, 100%;
      }
      .hero img {
        max-width: 35%;
        filter: brightness(1.2) contrast(1.2);
      }
      .hero {
          position: relative;
       }
      .hero:before, .hero:after {
          z-index: -1;
          position: absolute;
          content: "";
          bottom: 40px;
          left: 5px;
          width: 50%;
          top: 50%;
          background: hsla(0, 0%, 46.667%, 0.6);
          box-shadow: 0 55px 30px hsla(0, 0%, 46.667%, 0.6);
          transform: rotate(-2deg);
       }
      .hero:after {
          transform: rotate(2deg);
          right: 5px;
          left: auto;
       }
    </style>
    <body>
        <section class="hero is-medium is-info is-bold">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <img src="/assets/img/lamp.png">
                    <br/><br/>
                    <h3 class="subtitle is-3">
                        Your local development environment
                    </h3>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <?php
                    $root   = './';
                    $ignore = array('..', '.', 'assets', 'index.php', 'phpinfo.php', 'test_db.php', 'test_db_pdo.php');
                    $dirs   = array_diff(scandir($root), $ignore);
                    $folders  = '';
                    foreach ($dirs as $dir) {
                        $folders .= '<li><a href="./'.$dir.'">'.$dir.'</a></li>';
                    }
                ?>
                <h3 class="title is-3 has-text-centered">Repositories</h3>
                <hr>
                <div class="menu">
                    <p class="menu-label">
                      Folders
                    </p>
                    <ul class="menu-list">
                        <?php echo $folders;?>
                    </ul>
                    <p class="menu-label">
                      Other
                    </p>
                    <ul class="menu-list">
                        
                    </ul>
                </div>
                    </div>
                    <div class="column">
                        <h3 class="title is-3 has-text-centered">Environment</h3>
                        <hr>
                        <div class="content">
                            <ul>
                                <li><?= apache_get_version(); ?></li>
                                <li>PHP <?= phpversion(); ?></li>
                                <li>
                                    <?php
                                    $link = mysqli_connect("database", "root", $_ENV['MYSQL_ROOT_PASSWORD'], null);
                                    /* check connection */
                                    if (mysqli_connect_errno()) {
                                        printf("MySQL connecttion failed: %s", mysqli_connect_error());
                                    } else {
                                        /* print server version */
                                        printf("MySQL Server %s", mysqli_get_server_info($link));
                                    }
                                    /* close connection */
                                    mysqli_close($link);
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <h3 class="title is-3 has-text-centered">Quick Links</h3>
                        <hr>
                        <div class="content">
                            <ul>
                                <li><a href="/phpinfo.php">phpinfo()</a></li>
                                <li><a href="http://<? print $_SERVER['SERVER_NAME'].':'.$_ENV['PMA_PORT']; ?>">phpMyAdmin</a></li>
                                <li><a href="/test_db.php">Test DB Connection with mysqli</a></li>
                                <li><a href="/test_db_pdo.php">Test DB Connection with PDO</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer">
          <div class="content has-text-centered">
            <p>
              <strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>.
              <br>
              <strong>LAMP</strong> by <a href="https://github.com/sprintcube/docker-compose-lamp">SprintCube</a>
            </p>
          </div>
        </footer>
    </body>
</html>
