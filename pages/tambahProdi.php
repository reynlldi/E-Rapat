<?php

    require_once('./class/class.Prodi.php');
    $objProdi = new Prodi();
    if(isset($_POST['btnSubmit'])){
        
        $objProdi->kaprodi = $_POST['kaprodi'];
        $objProdi->namaProdi = $_POST['namaProdi'];


        if(isset($_GET['IDProdi'])){
            $objProdi->IDProdi = $_GET['IDProdi'];
            $objProdi->UpdateProdi();
        }else{
            $objProdi->AddProdi();
        }

        echo "<script> alert('$objProdi->message'); </script>";
        if($objProdi->hasil){
            echo '<script> window.location = "dashboardAdmin.php?p=adminListProdi"; </script>';
        }

        
    } else if(isset($_GET['IDProdi'])){
        $objProdi->IDProdi = $_GET['IDProdi'];
        $objProdi->SelectOneProdi();
    }
?>
<div class="container">
  <div class="wrapper">
    <div class="row justify-content-center align-items-center " style="height:100%">
      <div class="col-sm-5">
        <div class="card shadow p-3 mb-5 mt-5 bg-white rounded border-0">
          <div class="card-body">
            <h2>Tambah Bidang</h2>
            <p>Tambahkan Bidang yang belum terdaftar</p>
            <form action="" autocomplete="off" method="POST" enctype="multipart/form-data">

              <div class="form-group mt-2">
                <label for="kaprodi">Nama Kepala Bidang</label>
                <input type="text" class="form-control" name="kaprodi" value="<?php echo $objProdi->kaprodi; ?>">
              </div>

              <div class="form-group mt-2">
                <label for="namaProdi">Nama Bidang</label>
                <input type="text" class="form-control" name="namaProdi" value="<?php echo $objProdi->namaProdi; ?>">
              </div>

              <div class="mt-2">
                <input type="submit" name="btnSubmit" style="background-color: #1f4690;"
                  class="btn text-light btn-block" value="Tambah">
                <a href="dashboardAdmin.php?p=adminListProdi" class="btn btn-danger btn-block">Batal</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>