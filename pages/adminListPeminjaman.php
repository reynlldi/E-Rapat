<div class="container">
  <div class="wrapper">
    <div class="Title">
      <div class="navbar ">
        <h2><i class='bx bx-calendar-check'></i> Peminjaman</h2>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="btn btn-danger mr-2" href="pages/report_peminjaman.php" target=_blank role="button"><i
                class='bx bx-download'></i> Download</a>
          </li>
        </ul>
      </div>
      <!-- Daftar Peminjaman Ruangan-->
      <?php
            $kategori = null;
            if (isset($_GET['kategori'])) {
                $kategori = $_GET['kategori'];
            } ?>
      <div class="row my-3">
        <div class="col-6">
          <h5>Kategori Ruangan: </h5>
        </div>
        <div class="col-sm-9">
          <a href="?p=adminListPeminjaman" class="btn btn-secondary me-1">Semua Ruang</a>
          <a href="?p=adminListPeminjaman&kategori=ruang_rapat_bawah"
            class="btn <?= $kategori == 'ruang_rapat_bawah' ? 'btn-primary' : 'btn-secondary' ?>">Ruang Rapat
            Bawah</a>
          <a href="?p=adminListPeminjaman&kategori=ruang_rapat_studio"
            class="btn <?= $kategori == 'ruang_rapat_studio' ? 'btn-primary' : 'btn-secondary' ?> me-1 mt-1 mb-1">Ruang
            Rapat
            Studio</a>
          <a href="?p=adminListPeminjaman&kategori=ruang_rapat_atas"
            class="btn <?= $kategori == 'ruang_rapat_atas' ? 'btn-primary' : 'btn-secondary' ?> m-1">Ruang Rapat
            Atas</a>

        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="thead-dark table-dark">
            <tr>
              <th scope="col">Peminjam</th>
              <th scope="col">Ruangan</th>
              <th scope="col">Keperluan</th>
              <th scope="col">Tanggal Pinjam</th>
              <th scope="col">Tanggal Selesai</th>
              <th scope="col">Jam Pinjam</th>
              <th scope="col">Jam Selesai</th>
              <th scope="col">Persetujuan</th>
              <th scope="col">Tindakan</th>
            </tr>
          </thead>
          <tbody>
            <?php
                        require_once('./class/class.Peminjaman.php');
                        $objPeminjaman = new Peminjaman_Ruangan();

                        if ($kategori == 'ruang_rapat_bawah')
                            $arrayPeminjaman = $objPeminjaman->SelectAllPeminjaman('Ruang Rapat Bawah');
                        elseif ($kategori == 'ruang_rapat_studio')
                            $arrayPeminjaman = $objPeminjaman->SelectAllPeminjaman('Ruang Rapat Studio');
                        elseif ($kategori == 'ruang_rapat_atas')
                            $arrayPeminjaman = $objPeminjaman->SelectAllPeminjaman('Ruang Rapat Atas');
                        else 
                            $arrayPeminjaman = $objPeminjaman->SelectAllPeminjaman();


                        if (count($arrayPeminjaman) == 0) {
                            echo '<tr><td colspan="8" style="text-align: center;"><i class="fas fa-calendar-times"></i>Tidak ada data!</td></tr>';
                        } else {
                            $objPeminjaman->IDPeminjaman;
                            foreach ($arrayPeminjaman as $dataPeminjaman) {
                                echo '<tr>';
                                echo '<td>' . $dataPeminjaman->user->nama . '</td>';
                                echo '<td>' . $dataPeminjaman->ruangan->namaRuangan . '</td>';
                                echo '<td>' . $dataPeminjaman->keperluan . '</td>';
                                echo '<td>' . $dataPeminjaman->tglPinjam . '</td>';
                                echo '<td>' . $dataPeminjaman->tglSelesai . '</td>';
                                echo '<td>' . $dataPeminjaman->jamPinjam . '</td>';
                                echo '<td>' . $dataPeminjaman->jamSelesai . '</td>';
                                echo '<td ';
                                if ($dataPeminjaman->persetujuan === 'Disetujui') {
                                    echo 'class="alert table-success" role="alert"><strong>' . $dataPeminjaman->persetujuan;
                                } elseif ($dataPeminjaman->persetujuan === 'Tidak disetujui') {
                                    echo 'class="alert table-danger" role="alert"><strong>' . $dataPeminjaman->persetujuan;
                                } else {
                                    echo 'class="alert table-warning" role="alert"><strong>' . $dataPeminjaman->persetujuan;
                                }
                                echo '</strong></td>';
                                echo '<td>';
                                if ($dataPeminjaman->persetujuan === 'Disetujui') {
                                    echo '<a class="btn btn-danger me-1" href="dashboardAdmin.php?p=peminjamanUndone&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="bx bx-x"></i> Batalkan</a>';
                                    echo '<a class="btn btn-danger" href="dashboardAdmin.php?p=deletePeminjaman&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'" onclick="return confirm(\'Apakah anda yakin ingin menghapus?\')"><i class="bx bx-trash"></i></a>';
                                } elseif ($dataPeminjaman->persetujuan === 'Tidak disetujui') {
                                    echo '<a class="btn btn-success me-1" href="dashboardAdmin.php?p=peminjamanApproval&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="bx bx-check"></i> Setujui</a>';
                                    echo '<a class="btn btn-danger" href="dashboardAdmin.php?p=deletePeminjaman&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'" onclick="return confirm(\'Apakah anda yakin ingin menghapus?\')"><i class="bx bx-trash"></i></a>';
                                } elseif ($dataPeminjaman->persetujuan === 'Belum disetujui') {
                                    if ($_SESSION["role"] == 'Admin') {
                                        echo '<a class="btn btn-success me-1" href="dashboardAdmin.php?p=peminjamanApproval&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="bx bx-check"></i> Setujui</a>';
                                        echo '<a class="btn btn-danger me-1" href="dashboardAdmin.php?p=peminjamanRejection&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'"><i class="bx bx-x"></i> Tolak</a>';
                                        echo '<a class="btn btn-danger" href="dashboardAdmin.php?p=deletePeminjaman&IDPeminjaman='.$dataPeminjaman->IDPeminjaman.'" onclick="return confirm(\'Apakah anda yakin ingin menghapus?\')"><i class="bx bx-trash"></i></a>';
                                    }
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>