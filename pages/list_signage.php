<meta http-equiv="refresh" content="414">
<div class="container mt-4">
  <div class="pt-2">
    <div class=" navbar ">
      <h2>Peminjaman Ruang Rapat Kantor Bapelitbang Kabupaten Bintan</h2>
      <ul class=" navbar-nav ml-auto">
      </ul>
    </div>
    <!-- Daftar Peminjaman Ruangan-->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="thead-dark table-dark">
          <tr class="text-center">
            <th scope="col">Peminjam</th>
            <th scope="col">Ruangan</th>
            <th scope="col">Rapat</th>
            <!-- <th scope="col">Tanggal Pinjam</th> -->
            <th scope="col">Tanggal Rapat</th>
            <th scope="col">Jam Rapat</th>
            <th scope="col">Jam Selesai Rapat</th>
            <!-- <th scope="col">Persetujuan</th> -->
          </tr>
        </thead>
        <tbody>
          <?php
                        require_once('./class/class.Peminjaman.php');
                        $objPeminjaman = new Peminjaman_Ruangan();
                        $arrayPeminjaman = $objPeminjaman->SelectSepuluhPeminjaman();

                        if(count($arrayPeminjaman) == 0){
                            echo '<tr><td colspan="8" style="text-align: center;"><i class="fas fa-calendar-times"></i> Tidak ada data peminjaman ruangan hari ini!</td></tr>';
                        } else{
                            $objPeminjaman->IDPeminjaman;
                            foreach ($arrayPeminjaman as $dataPeminjaman) {
                                echo '<tr class="text-center">';
                                echo '<td>'.$dataPeminjaman->user->nama.'</td>';
                                echo '<td>'.$dataPeminjaman->ruangan->namaRuangan.'</td>';
                                echo '<td>'.$dataPeminjaman->keperluan.'</td>';
                                // echo '<td>'.$dataPeminjaman->tglPinjam.'</td>';
                                echo '<td>'.$dataPeminjaman->tglSelesai.'</td>';
                                echo '<td>'.$dataPeminjaman->jamPinjam.'</td>';
                                echo '<td>'.$dataPeminjaman->jamSelesai.'</td>';
                                // echo '<td ';
                                //     if ($dataPeminjaman->persetujuan === 'Disetujui') {
                                //         echo 'class="alert alert-success" role="alert"><strong>'.$dataPeminjaman->persetujuan;
                                //     } elseif ($dataPeminjaman->persetujuan === 'Tidak disetujui') {
                                //         echo 'class="alert alert-danger" role="alert"><strong>'.$dataPeminjaman->persetujuan;
                                //     } else {
                                //         echo 'class="alert alert-warning" role="alert"><strong>'.$dataPeminjaman->persetujuan;
                                //     }
                                // echo '</strong></td>';
                                // echo '<td>';
                                //     if ($dataPeminjaman->persetujuan === 'Disetujui') {
                                        
                                //     } elseif ($dataPeminjaman->persetujuan === 'Tidak disetujui') {
                                        
                                //     } elseif($dataPeminjaman->persetujuan === 'Persetujuan 1'){
                                       
                                //     } elseif ($dataPeminjaman->persetujuan === 'Belum disetujui') {
                                        
                                //     }
                                // echo '</td>';
                                echo '</tr>';
                            }
                        }
                    ?>
        </tbody>
      </table>
    </div>
  </div>
</div>