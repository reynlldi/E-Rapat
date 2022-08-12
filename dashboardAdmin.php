<?php
require_once('pages/authorization_admin.php');
require "inc.koneksi.php";

// if (time() - $_SESSION['timestamp'] > 10) { //subtract new timestamp from the old one
//     echo "<script>alert('Tidak aktif selama 10 detik, Anda akan keluar.');</script>";
//     unset($_SESSION["UserID"], $_SESSION["role"], $_SESSION["nama"], $_SESSION["email"], $_SESSION["timestamp"]);
//     $_SESSION['logged_in'] = false;
//     echo '<script> window.location="index.php"; </script>';
//     exit;
// } else {
//     $_SESSION['timestamp'] = time(); //set new timestamp
// }

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="300;url=?p=logout" />
  <!-- css -->
  <link rel="stylesheet" href="sidebar.css">
  <!-- js -->
  <script src="sidebar.js"></script>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <!-- ajax -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link rel="icon" href="favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

  <title>Ruang Rapat</title>
</head>

<body id="body-pd" class="d-flex flex-column min-vh-100">
  <header class="header" id="header">
    <div class="header_toggle">
      <i class='bx bx-menu' id="header-toggle"></i>
    </div>
    <div class="dropdown">
      <a class="dropdown-toggle text-dark text-decoration-none" href="#" role="button" id="dropdownMenuButton1"
        data-bs-toggle="dropdown" aria-expanded="true">
        <?php echo 'Selamat Datang, <strong>' . $_SESSION["nama"] . '</strong>' ?>
      </a>

      <ul class=" dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="dashboardAdmin.php?p=adminProfile"><i class="fa-solid fa-user"></i>
            Profil</a>
        </li>
        <li><a class="dropdown-item" href="dashboardAdmin.php?p=adminListAdmin"><i class="fa-solid fa-list-ol"></i>
            List
            Admin</a></li>

        <?php
                if ($_SESSION["role"] == 'Admin') {
                    echo '<a class="dropdown-item" href="dashboardAdmin.php?p=tambahAdmin"><i class="fa-solid fa-user-plus"></i> Tambah Admin </a>';
                }
                ?>
        <li><a class="dropdown-item" href="signage.php" target="_blank"><i class="fa-solid fa-display"></i> Display
            Informasi</a></li>
        <li><a class="dropdown-item" href="dashboardAdmin.php?p=updatepassword"><i class="fa-solid fa-key"></i>
            Update Password</a></li>
        <hr>
        <li><a class="dropdown-item" href="dashboardAdmin.php?p=logout"><i class="fa-solid fa-right-from-bracket"></i>
            Logout</a></li>
      </ul>
    </div>
  </header>

  <div class="l-navbar" id="nav-bar">
    <nav class="nav">
      <div>
        <a href="index.php" class="nav_logo">
          <i class='bx bx-layer nav_logo-icon'></i>
          <span class="nav_logo-name">E-Rapat</span>
        </a>
        <div class="nav_list">
          <a href="dashboardAdmin.php?p=adminListPeminjaman" class="nav_link ">
            <i class='bx bx-calendar-check nav_icon'></i>
            <span class="nav_name">Peminjaman</span>
          </a>
          <a href="dashboardAdmin.php?p=adminListRuangan" class="nav_link">
            <i class='bx bx-door-open nav_icon'></i>
            <span class="nav_name">Ruangan</span>
          </a> <a href="dashboardAdmin.php?p=adminListProdi" class="nav_link">
            <i class='bx bx-sitemap nav_icon'></i>
            <span class="nav_name">Bidang</span>
          </a>
          <a href="dashboardAdmin.php?p=adminListUser" class="nav_link">
            <i class='bx bx-user nav_icon'></i>
            <span class="nav_name">Pengguna</span>
          </a>
        </div>
      </div>
    </nav>
  </div>

  <!--Container Main start-->
  <div class="mt-5">
    <div class="container-fluid bg-light pb-5 pt-3">
      <?php
        $pages_dir = 'pages';
        if (!empty($_GET['p'])) {
            $pages = scandir($pages_dir, 0);
            unset($pages[0], $pages[1]);

            $p = $_GET['p'];
            if (in_array($p . '.php', $pages)) {
                include($pages_dir . '/' . $p . '.php');
            } else {
                echo '<div class="container">';
                echo '<h1></br>4😕4</h1>';
                echo '<h2>Halaman yang kamu cari ga ada!</h2>';
                echo '</br>';
                echo '<a href="dashboardAdmin.php">&larr; Go Home</a>';
                echo '</div>';
            }
        } else {
            include($pages_dir . '/adminListPeminjaman.php');
        }
        ?>
    </div>
  </div>
  <!--Container Main end-->

  <footer class="container-fluid bg-white border-top text-center mt-auto">
    <div class="container footer">
      <small>&copy; Copyright 2022, Aplikasi Ruang Rapat. <a href="https://bapelitbang.bintankab.go.id/"
          style="text-decoration: none;"> Bapelitbang
          Bintan </a></small>
    </div>
  </footer>

</html>