  <?php
    require_once('./class/class.Register.php');
    require_once('./class/class.Peminjam.php');

    if (isset($_POST['btnLogin'])) {

        $inputEmail = $_POST['email'];
        $inputPassword = $_POST['pwd'];

        $objRegister = new Register();
        $objPeminjam = new Peminjam();
        $objRegister->ValidateEmail($inputEmail);

        if ($objRegister->hasil) {

            $ismatch = password_verify($inputPassword, $objRegister->password);

            if ($ismatch) {
                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION["UserID"] = $objRegister->UserID;
                $_SESSION["role"] = $objRegister->role;
                $_SESSION["nama"] = $objRegister->nama;
                $_SESSION["email"] = $objRegister->email;


                echo "<script> alert('Login sukses!'); </script>";

                if ($objRegister->role == 'Mahasiswa')
                    echo '<script> window.location = "dashboardMahasiswa.php"; </script>';
                else if ($objRegister->role == 'Dosen')
                    echo '<script> window.location = "dashboardMahasiswa.php"; </script>';
                else if ($objRegister->role == 'Kabid')
                    echo '<script> window.location = "dashboardAdmin.php"; </script>';
                else if ($objRegister->role == 'Admin')
                    echo '<script> window.location = "dashboardAdmin.php"; </script>';
                else if ($objRegister->role == 'Staf')
                    echo '<script> window.location = "dashboardStaf.php"; </script>';
            } else {
                echo "<script> alert('Password tidak match!'); </script>";
            }
        } else {
            echo "<script> alert('Email tidak terdaftar!'); </script>";
        }
    }
    ?>

  <div class="container">
    <div class="row justify-content-center align-items-center " style="min-height:85vh">
      <div class="col-sm-4">
        <div class="card shadow pl-2 pr-2 mb-4 mt-5 bg-white rounded border-0">
          <div class="card-body">
            <div class="text-center">
              <img src="images/bintan.png" alt="logo" width="150px" height="90px">
              <h3 style="font-family: 'Alegreya', serif;">E-Rapat</h3>
            </div>
            <!-- <h2 class="text-center">E-Rapat</h2> -->
            <form action="" method="post">

              <div class="form-group"> <label for="email">Alamat Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
              </div>


              <div class="form-group"> <label for="pwd">Kata Sandi</label>
                <!-- <input type="password" class="form-control" name="pwd" id="pwd" maxlength="20" required> -->
                <div class="input-group">
                  <input type="password" class="form-control pwd" id="pwd" name="pwd" maxlength="20" required>
                  <span class="input-group-btn">
                    <button style="background-color: #1f4690;" class="btn reveal" type="button"><i
                        class="fa fa-eye text-light"></i></button>
                  </span>
                </div>
              </div>

              <!-- <div class="form-group form-check custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input form-check-input" id="remember">
                            <label class="custom-control-label form-check-label" for="remember">Remember me</label>
                        </div> -->

              <input type="submit" name="btnLogin" class="btn btn-block text-light" value="Login"
                style="background-color: #1f4690;">
              <a href="index.php" class="btn btn-danger btn-block">Batal</a></td>

            </form>
            <p class="text-center mt-2"><small>Belum punya akun? <a href="index.php?p=register">Daftar
                  sekarang</a></small>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
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