<?php

    require_once('./class/class.Register.php');
    require_once('./class/class.Prodi.php');
    require_once('./class/class.Peminjam.php');
    require_once('./class/class.Mail.php');

    $objRegister = new Register();
    $objPeminjam = new Peminjam();
    $objProdi = new Prodi();

    $prodiList = $objProdi->SelectAllProdi();

    if(isset($_POST['btnSubmit'])){
        $inputEmail = $_POST['email'];
        
        $objRegister->ValidateEmail($inputEmail);
        $objRegister->hasil = false;

        if ($objRegister->hasil) {
            echo "<script> alert('Email sudah terdaftar'); </script>";
        }else {
            $objRegister->email = $_POST['email'];
            $password = $_POST['pass'];
            $objRegister->password = password_hash($password, PASSWORD_DEFAULT);
            $objRegister->nama = $_POST['fullname'];
            $objRegister->alamat = $_POST['address'];
            $objRegister->role = $_POST['pekerjaan'];
            $objRegister->noTelp = $_POST['noTelp'];
            $objRegister->gender = $_POST['jenisKelamin'];

            $objPeminjam->IDProdi = $_POST['prodi'];
            $IDPeminjam = $objRegister->AddMember();
            $objPeminjam->AddPeminjam($IDPeminjam);

            if($objPeminjam->hasil){			
                $message =  file_get_contents('templateemail.html');  					 
                $header = "Registrasi berhasil";
                $body = '<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                        Selamat <b>' .$objRegister->nama.'</b>, anda telah terdaftar pada sistem peminjaman ruangan rapat.<br>
                        Berikut ini informasi akun anda:<br>
                        </span>
                        <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                            Username : '.$objRegister->email.'<br>
                            Password : '.$password.'
                        </span>';
                $footer ='Silakan login untuk mengakses sistem peminjaman ruangan';
                                            
                $message = str_replace("#header#",$header,$message);
                $message = str_replace("#body#",$body,$message);
                $message = str_replace("#footer#",$footer,$message);
                                                 
                $objMail = new Mail();
                $objMail->SendMail($objRegister->email, $objRegister->nama, 'Registrasi berhasil', $message);	
                echo "<script> alert('Registrasi berhasil'); </script>";
                echo '<script> window.location="index.php?p=login"; </script>'; 				
            }
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
  <title>Tambah Pengguna</title>
</head>

<body>
  <div class="container">
    <div class="wrapper">
      <div class="row justify-content-center align-items-center " style="height:100%">
        <div class="col-sm-7 ">
          <div class="card shadow p-3 mt-5 bg-white rounded border-0">
            <div class="card-body">

              <h2>Tambah Pengguna</h2>
              <p>Daftar menjadi peminjam ruang rapat</p>
              <form action="" autocomplete="off" method="POST">

                <!-- Full Name -->

                <div class="form-group"> <label for="fullName">Nama Lengkap</label>
                  <input type="text" class="form-control" name="fullname" id="fullName">
                </div>

                <!-- Email -->
                <div class="form-group mt-2">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email">
                </div>

                <!-- Password -->
                <div class="form-group mt-2">
                  <label for="pass">Kata Sandi</label>
                  <!-- <input type="password" class="form-control" id="pass" name="pass" autocomplete="off"> -->
                  <div class="input-group">
                    <input type="password" class="form-control pwd" id="pass" name="pass">
                    <span class="input-group-btn">
                      <button style="background-color: #1f4690;" class="btn reveal" type="button"><i
                          class="fa fa-eye text-light"></i></button>
                    </span>
                  </div>
                </div>

                <!-- Pekerjaan/Role -->

                <div class="custom-control custom-radio custom-control-inline mt-2">

                  <input type="radio" id="roleUmum" name="pekerjaan" class="custom-control-input" value="Staf"
                    data-target="#umum" checked="checked">
                  <label class="custom-control-label" for="roleUmum">Staf</label>
                </div>


                <!-- Tab Input NIM, NIDN, dan Umum -->
                <div class="tab-content mt-2">
                  <div class="form-group tab-pane" id="nim-content">
                    <label for="nim">NIM</label>
                    <input type="number" class="form-control" name="nim" id="nim">
                  </div>
                  <div class="form-group tab-pane" id="nidn-content">
                    <label for="nidn">NIDN</label>
                    <input type="number" class="form-control " name="nidn" id="nidn">
                  </div>
                  <div id="umum">
                  </div>
                </div>

                <!-- Prodi -->
                <div class="form-group mt-2">
                  <label for="prodi">Bidang</label>
                  <select name="prodi" class="form-control" id="prodi">
                    <?php
                                        foreach($prodiList as $prodi){
                                            echo '<option value='.$prodi->IDProdi.'>'.$prodi->namaProdi.'</option>';
                                        }
                                    ?>
                  </select>
                </div>

                <!-- Alamat -->
                <div class="form-group mt-2">
                  <label for="address">Alamat</label>
                  <textarea class="form-control" name="address" id="address" rows="1" style="height:100%"></textarea>
                </div>

                <!-- Nomer Telepon -->
                <div class="form-group mt-2">
                  <label for="noTelp">Nomor Telepon</label>
                  <input type="number" class="form-control" name="noTelp" id="noTelp">
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group mt-2">
                  <label for="jenisKelamin">Jenis Kelamin</label></br>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="laki" name="jenisKelamin" class="custom-control-input" value="M">
                    <label class="custom-control-label" for="laki">Laki-laki</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="perempuan" name="jenisKelamin" class="custom-control-input" value="F">
                    <label class="custom-control-label" for="perempuan">Perempuan</label>
                  </div>
                </div>

                <div class="mt-2">
                  <input type="submit" name="btnSubmit" style="background-color: #1f4690;"
                    class="btn text-light btn-block" value="Tambah">
                  <a href="index.php?p=login" class="btn btn-danger btn-block">Batal</a>
                </div>

              </form>
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