<?php 	
    require "inc.koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">
  <link rel="icon" href="favicon.ico">
  <link rel="stylesheet" href="styles.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <script src="https://kit.fontawesome.com/1d092830da.js" crossorigin="anonymous"></script>
  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <script type="text/javascript">
  function displayTime() {
    var clientTime = new Date();
    var time = new Date(clientTime.getTime());
    var sh = time.getHours().toString();
    var sm = time.getMinutes().toString();
    var ss = time.getSeconds().toString();
    document.getElementById("jam").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm :
      sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
    // document.getElementById("jaminput").value = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm :
    //   sm) + ":" + (ss.length == 1 ? "0" + ss : ss);

  }
  </script>
  <style type="text/css" ;>
  .video {
    width: 100vw;
    height: 100vh;
    object-fit: cover;
    position: fixed;
    top: 0;
    left: 0;
    z-index: -1;
  }

  .tg {
    border-collapse: collapse;
    border-spacing: 0;
  }

  .tg td {
    font-family: Arial, sans-serif;
    font-size: 14px;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
  }

  .tg th {
    border-color: black;
    border-style: solid;
    border-width: 1px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-weight: normal;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
  }

  .tg .tg-0lax {
    text-align: left;
    vertical-align: top
  }
  </style>
  <title>Informasi</title>
</head>

<body onload="setInterval('displayTime()', 1000);">
  <!-- <video poster="images/1.jpg" autoplay playsinline muted loop>
    <source src="" type="video/mp4">
  </video> -->

  <iframe class="video" src="https://www.youtube.com/embed/VWysD4gwoOw?autoplay=1&mute=1" title="YouTube video player"
    frameborder="0" allow=" clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  <table class="tg" style="width: 100%;">
    <thead>
      <tr>
        <td class="tg-0lax text-center"><img src="images/bintan.png" alt="Logo Bintan" width="460" height="300"></td>

        <td class="tg-0lax" rowspan="2">
          <div class="col-sm-12">
            <main class="container-fluid bg-light pb-3">
              <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $pages_dir = 'pages';
                        if(!empty($_GET['p'])){
                            $pages = scandir($pages_dir, 0);
                            unset($pages[0], $pages[1]);

                            $p = $_GET['p'];
                            if(in_array($p.'.php', $pages)){
                                    include($pages_dir.'/'.$p.'.php');
                            } else {
                                echo '<div class="container">';
                                echo '<h1></br>4😕4</h1>';
                                echo '<h2>Halaman yang kamu cari ga ada!</h2>';
                                echo '</br>';
                                echo '<a href="dashboardAdmin.php">&larr; Go Home</a>';
                                echo '</div>';
                            }
                        } else {

                            include($pages_dir.'/list_signage.php');
                        }
                    ?>
            </main>

          </div>
        </td>
      </tr>
      <tr>
        <td class="tg-0lax"><iframe width="560" height="315"
            src="https://www.youtube.com/embed/WemeIY5-P6o?autoplay=1&mute=1" title="YouTube video player"
            frameborder="0" allow=" clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </td>
      </tr>
    </thead>
  </table>
  <footer class="pt-5">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top: 75px;">
      <tr align="center" bgcolor="001D6E" valign="middle">
        <td bgcolor="001D6E" width="287">
          <font size=3 class="text-light">
            <font face="Arial, Helvetica, sans-serif" color="#ffffff" size="4"><?php echo date ("l, d M Y");?>
            </font>
          </font>
        </td>
        <td width="800" align="center" valign="middle"
          style="padding-left:20px; padding-right:20px; background-size:1000px " bgcolor="001D6E">
          <marquee direction="left" scrolldelay="90">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr valign="middle">
                <h1 style="color: #ffffff;" align="center">Website E-Rapat Bapelitbang Kabupaten Bintan</h1>
              </tr>
            </table>
          </marquee>
        </td>
        <td style="color: #9C0" width="95" align="middle" class="text-light" id="jam"></td>
      </tr>
    </table>
  </footer>
</body>

</html>