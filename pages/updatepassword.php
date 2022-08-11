<?php
    require_once('./class/class.Register.php');
    require_once('./class/class.Peminjam.php');
    // include('inc.koneksi.php');
    $conn = mysqli_connect ("localhost", "root", "" ,"roombookingsystem2");

    if (isset($_POST['btnUpdate'])) {

      $objRegister = new Register();
      $objPeminjam = new Peminjam();

      $opass = $_POST['opass'];
      $npass = $_POST['npass'];
      $cnpass = $_POST['cnpass'];

      $sql = "SELECT * FROM userruangan WHERE UserID = '" . $_SESSION['UserID'] . "'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_object($result);

      if (password_verify($opass, $row->password))
      {
        if ($npass == $cnpass)
        {
          
          $sql = "UPDATE userruangan SET password = '" . password_hash($npass, PASSWORD_DEFAULT) . "' WHERE UserID = '" . $_SESSION['UserID'] . "'";
          mysqli_query($conn, $sql);

          echo "<script> alert('Password berhasil diubah!'); </script>";
        }
        else
        {
          echo "<script> alert('Password baru dan konfirmasi password baru tidak match!'); </script>";
        }
      }
        else
        {
          echo "<script> alert('Password lama tidak match!'); </script>"; 
        }
      }
    
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

  <title>Update Profil</title>
</head>

<body>
  <div class="container">
    <div class="wrapper">
      <div class="row justify-content-center align-items-center " style="height:100%">
        <div class="col-md-9">
          <div class="card shadow p-3 mb-5 mt-5 bg-white rounded border-0">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h4>Update Password</h4>
                  <hr>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <form action="" autocomplete="off" method="POST">

                    <!-- Full Name -->
                    <div class="form-group mt-2">
                      <label for="pass">Password Lama</label>
                      <div class="input-group">
                        <input type="password" class="form-control pwd" id="pass" name="opass" autocomplete="off"
                          value="" required>
                        <!-- <span class="input-group-btn">
                          <button style="background-color: #1f4690;" class="btn reveal" type="button"><i
                              class="fa fa-eye text-light"></i></button>
                        </span> -->
                      </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group mt-2">
                      <label for="pass">Password Baru</label>
                      <div class="input-group">
                        <input type="password" class="form-control pwd" id="pass" name="npass" autocomplete="off"
                          value="" required>
                        <!-- <span class="input-group-btn">
                          <button style="background-color: #1f4690;" class="btn reveal" type="button"><i
                              class="fa fa-eye text-light"></i></button>
                        </span> -->
                      </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-2">
                      <label for="pass">Konformasi Password Baru</label>
                      <div class="input-group">
                        <input type="password" class="form-control pwd" id="pass" name="cnpass" autocomplete="off"
                          value="" required>
                        <!-- <span class="input-group-btn">
                          <button style="background-color: #1f4690;" class="btn reveal" type="button"><i
                              class="fa fa-eye text-light"></i></button>
                        </span> -->
                      </div>
                    </div>
                    <div class="mt-2">
                      <input type="submit" name="btnUpdate" style="background-color: #1f4690;"
                        class="btn text-light btn-block" value="Simpan">
                      <a href="dashboardMahasiswa.php" class="btn btn-danger btn-block">Batal</a>
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>


<!-- JS Tab Control -->
<script>
$(document).ready(function() {
  $('input[name="pekerjaan"]').click(function() {
    $(this).tab('show');
    $(this).removeClass('active');
  });
});

$(".reveal").on('click', function() {
  const show = $('.fa');
  $(show).toggleClass('.fa fa-eye-slash');
  $(this).toggleClass('active');
  var $pwd = $(".pwd");
  if ($pwd.attr('type') === 'password') {
    $pwd.attr('type', 'text');
  } else {
    $pwd.attr('type', 'password');
  }
});
</script>