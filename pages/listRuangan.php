<div class="container">
  <div class="wrapper">

    <!-- <div class="Title">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Welcome to Room Booking System, <?php echo '<strong>' . $_SESSION["nama"] . '</strong>' ?>. You log in as <?php echo $_SESSION["role"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->


    <div class="navbar">
      <h2><i class='bx bx-calendar-check'></i> Peminjaman </h2>
    </div>

    <?php
        $kategori = null;
        if (isset($_GET['kategori'])) {
            $kategori = $_GET['kategori'];
        } ?>
    <div class="row my-3">
      <div class="col-6">
        <h4>Filter Kategori: </h4>
      </div>
      <div class="col-sm-9">
        <a href="?p=listRuangan" class="btn btn-secondary me-1">Semua Ruangan</a>
        <a href="?p=listRuangan&kategori=ruang_rapat_bawah"
          class="btn <?= $kategori == 'ruang_rapat_bawah' ? 'btn-primary' : 'btn-secondary' ?>">Ruang Rapat
          Bawah</a>
        <a href="?p=listRuangan&kategori=ruang_rapat_studio"
          class="btn <?= $kategori == 'ruang_rapat_studio' ? 'btn-primary' : 'btn-secondary' ?> me-1 mt-1 mb-1">Ruang
          Rapat Studio</a>
        <a href="?p=listRuangan&kategori=ruang_rapat_atas"
          class="btn <?= $kategori == 'ruang_rapat_atas' ? 'btn-primary' : 'btn-secondary' ?> m-1">Ruang Rapat Atas</a>
      </div>
    </div>

    <!-- Daftar Ruangan Yang Bisa Dipinjam -->
    <table class="table table-bordered">
      <thead class="thead-dark table-dark">
        <tr>
          <th scope="col">Ruangan</th>
          <th scope="col">Keperluan</th>
          <th scope="col">Tanggal Pinjam</th>
          <th scope="col">Tanggal Selesai</th>
          <th scope="col">Jam Pinjam</th>
          <th scope="col">Jam Selesai</th>
          <th scope="col">Persetujuan</th>
        </tr>
      </thead>
      <tbody>
        <?php
                require_once('./class/class.Peminjaman.php');
                $objPeminjaman = new Peminjaman_Ruangan();

                if ($kategori == 'ruang_rapat_bawah')
                    $arrayPeminjaman = $objPeminjaman->SelectAllPeminjamanUser('Ruang Rapat Bawah');
                elseif ($kategori == 'ruang_rapat_studio')
                    $arrayPeminjaman = $objPeminjaman->SelectAllPeminjamanUser('Ruang Rapat Studio');
                elseif ($kategori == 'ruang_rapat_atas')
                    $arrayPeminjaman = $objPeminjaman->SelectAllPeminjamanUser('Ruang Rapat Atas');
                else
                    $arrayPeminjaman = $objPeminjaman->SelectAllPeminjamanUser();

                if (count($arrayPeminjaman) == 0) {
                    echo '<tr><td colspan="7" class="text-center">Tidak ada data!</td></tr>';
                } else {
                    foreach ($arrayPeminjaman as $dataPeminjaman) {
                        echo '<tr>';
                        echo '<td style="white-space: nowrap; overflow: hidden; width: 70px; text-overflow: ellipsis; table-layout: fixed">' . $dataPeminjaman->ruangan->namaRuangan . '</td>';
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
                  
                        echo '</tr>';
                    }
                }
                ?>
      </tbody>
    </table>

    <div class="navbar">
      <h2><i class="fas fa-door-open"></i> Pilih Ruangan</h2>
    </div>
    <!-- Daftar Ruangan Yang Bisa Dipinjam -->
    <div class="row row-cols-1 row-cols-md-3 m-0">
      <?php
            require_once('./class/class.Ruangan.php');
            $objRuangan = new Ruangan();
            $arrayResult = $objRuangan->SelectAllRuangan();

            if (count($arrayResult) == 0) {
                echo '<h3>Tidak ada data!</h3>';
            } else {
                $objRuangan->IDRuangan;
                foreach ($arrayResult as $dataRuangan) {
                    echo '<div class="col-mb-4">';
                    echo '<div class="card cardRuangan mr-5 mt-4">';
                    echo '<img src="upload/' . $dataRuangan->fotoRuangan . '" class="card-img-top" style=" height: 300px;" alt="' . $dataRuangan->namaRuangan . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $dataRuangan->namaRuangan . '</h5>';
                    echo '<ul>';
                    echo '<li>Lantai: ' . $dataRuangan->lantai . '</li>';
                    echo '<li>Kapasitas: ' . $dataRuangan->kapasitas . '</li>';
                    echo '</ul>';
                    echo '<a class="btn text-light btn-block mb-1" style="background-color: #1f4690;" href="dashboardMahasiswa.php?p=formPinjam&IDRuangan=' . $dataRuangan->IDRuangan . '&namaRuangan=' . $dataRuangan->namaRuangan . '" role="button"><i class="fa-solid fa-book-medical"></i> Pinjam</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
    </div>
  </div>
</div>
</div>