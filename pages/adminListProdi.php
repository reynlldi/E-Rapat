<div class="container">
  <div class="wrapper">
    <div class="Title">
      <div class="navbar ">

        <h2><i class="fas fa-university"></i> List Bidang</h2>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <?php
                        if ($_SESSION["role"] == 'Admin') {
                         echo '<a class="btn text-light mr-2"  href="dashboardAdmin.php?p=tambahProdi" style="background-color: #1f4690;" role="button"><i class="bx bx-plus"></i> Bidang</a>';
                        }
                    ?>
          </li>
        </ul>
      </div>
      <table class="table table-bordered">
        <thead class="thead-dark table-dark">
          <tr>
            <th scope="col">No.</th>

            <th scope="col">ID Bidang</th>
            <th scope="col">Nama Bidang</th>
            <th scope="col">Kepala Bidang</th>
            <?php
                            if ($_SESSION["role"] == 'Admin') { 
                                echo '<th scope="col">Action</th>';
                            }
                        ?>
          </tr>
        </thead>
        <tbody>
          <?php
                        require_once('./class/class.Prodi.php');
                        $objProdi = new Prodi();
                        $arrayResultProdi = $objProdi->SelectAllProdi();

                        $no = 1;
                        if (count($arrayResultProdi) === 0) {
                            echo '<tr><td colspan="3" style="text-align: center;">Tidak ada data!</td></tr>';
                        }else {
                            foreach($arrayResultProdi as $dataProdi){
                                echo '<tr>';
                                echo '<td>'.$no.'</td>';
                                echo '<td>'.$dataProdi->IDProdi.'</td>';
                                echo '<td>'.$dataProdi->namaProdi.'</td>';
                                echo '<td>'.$dataProdi->kaprodi.'</td>';
                                if ($_SESSION["role"] == 'Admin') { 
                                echo '<td><a class="btn btn-warning" href="dashboardAdmin.php?p=tambahProdi&IDProdi='.$dataProdi->IDProdi.'"><i class="bx bx-edit-alt"></i> Edit</a> <a class="btn btn-danger" href="dashboardAdmin.php?p=deleteProdi&IDProdi='.$dataProdi->IDProdi.'" onclick="return confirm(\'Apakah anda yakin ingin menghapus?\')"><i class="bx bx-trash"></i> Delete</a></td>';
                                }
                                echo '</tr>';
                                $no++;
                            }
                        }
                    ?>
        </tbody>
      </table>
    </div>
  </div>
</div>