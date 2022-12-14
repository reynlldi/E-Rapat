<div class="container">
  <div class="wrapper">
    <div class="Title">
      <div class="navbar ">
        <h2><i class="fas fa-users"></i> List Pengguna</h2>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <?php
                        if ($_SESSION["role"] == 'Admin') {
                            echo '<a class="btn text-light mr-2"  href="dashboardAdmin.php?p=register" style="background-color: #1f4690;" role="button"><i class="bx bx-plus"></i> Pengguna</a>';
                        }
                    ?>
            <a class="btn btn-danger mr-2" href="pages/report_user.php" target=_blank role="button"><i
                class="bx bx-download"></i> Download</a>
          </li>
        </ul>
      </div>
      <table class="table table-bordered">
        <thead class="thead-dark table-dark">
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Role</th>
            <th>No. Telp</th>
            <th>Gender</th>
            <?php
                            if ($_SESSION["role"] == 'Admin') { 
                                echo '<th>Tindakan</th>';
                            }
                        ?>
          </tr>
        </thead>
        <tbody>
          <?php
                        require_once('./class/class.Register.php');
                        $objRegister = new Register();
                        $arrayResult = $objRegister->SelectAllMember();

                        if (count($arrayResult) === 0) {
                            echo '<tr><td colspan="8" style="text-align: center;">Tidak ada data!</td></tr>';
                        }else {
                            $no = 1;
                            foreach($arrayResult as $dataUser){
                                if ($dataUser->role == 'Admin' OR $dataUser->role == 'Kabid' OR $dataUser->role == 'Staf') {
                                echo '<tr>';
                                echo '<td>'.$no.'</td>';
                                echo '<td>'.$dataUser->nama.'</td>';
                                echo '<td>'.$dataUser->email.'</td>';
                                echo '<td>'.$dataUser->alamat.'</td>';
                                echo '<td>'.$dataUser->role.'</td>';
                                echo '<td>'.$dataUser->noTelp.'</td>';
                                echo '<td>'.$dataUser->gender.'</td>';
                                if ($_SESSION["role"] == 'Admin') {                             
                                echo '<td><a class="btn btn-warning" href="dashboardAdmin.php?p=user&UserID='.$dataUser->UserID.'"><i class="bx bx-edit"></i> Edit</a> 
                                            <a class="btn btn-danger" href="dashboardAdmin.php?p=deleteUser&UserID='.$dataUser->UserID.'" onclick="return confirm(\'Apakah anda yakin ingin menghapus?\')"><i class="bx bx-trash"></i> Delete</a></td>';
                                }
                                echo '</tr>';
                                $no++;
                                }
                            }
                        }
                    ?>
        </tbody>
      </table>
    </div>
  </div>
</div>