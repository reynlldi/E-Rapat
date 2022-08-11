<?php
include_once 'class.Ruangan.php';
include_once 'class.Register.php';
class Peminjaman_Ruangan extends Connection
{
    public $jamPinjam = '';
    public $jamSelesai = '';
    public $lamaPinjam = '';
    public $keperluan = '';
    public $tglSelesai = '';
    public $tglPinjam = '';
    public $persetujuan = '';
    public $tglPersetujuan = '';
    public $IDPeminjaman = '';
    public $UserID = '';
    public $IDRuangan = '';
    public $role = '';

    public $hasil = false;
    public $message = '';

    function __construct()
    {
        $this->ruangan = new Ruangan();
        $this->user = new Register();
    }


    public function AddPeminjaman()
    {
        $this->connect();
        if ($this)
            //tampung variable
            $cekid = $this->IDRuangan;
        $cekjamP = $this->jamPinjam;
        $cekjams = $this->jamSelesai;
        $cektp = $this->tglPinjam;
        $cekts = $this->tglSelesai;

        $tglawal = strtotime($cektp);
        $tglakh = strtotime($cekts);

        $jmp = strtotime($cekjamP);
        $jmk = strtotime($cekjams);

        $cekjam1 = mysqli_real_escape_string($this->connection, $cekjamP);
        $cekjam2 = mysqli_real_escape_string($this->connection, $cekjams);

        $cekjam = "SELECT * FROM `peminjaman_ruangan` WHERE IDRuangan  LIKE '%$cekid%' AND jamSelesai  BETWEEN '$cekjam1' AND '$cekjam2' AND tglPinjam LIKE '%$cektp%' AND tglSelesai LIKE '%$cekts%'";
        $resultcekjam = mysqli_query($this->connection, $cekjam);

        $cekjamrow = mysqli_num_rows($resultcekjam);

        //cek data sesuai dengan yang ada pada inputan 

        $cekdata = "SELECT * FROM `peminjaman_ruangan` WHERE IDRuangan  LIKE '%$cekid%' AND jamPinjam  LIKE '%$cekjamP%' AND jamSelesai LIKE'%$cekjams%' AND tglPinjam LIKE '%$cektp%' AND tglSelesai LIKE '%$cekts%'";

        $result_cek = mysqli_query($this->connection, $cekdata);
        //masukkan jumlah record yang didapatkan pada hasil cek data
        $cek = mysqli_num_rows($result_cek);
        //jika record kurang dari 1 maka booking bisa dilakukan, jika record lebih dari satu maka booking tidak bisa dilakukan
        if ($cekjamrow < 1  ) {

            if ($cek < 1) {

                if ($tglawal < $tglakh && $jmk < $jmp) {
                    $sql = "INSERT INTO peminjaman_ruangan (jamPinjam, lamaPinjam, jamSelesai, keperluan, tglSelesai, tglPinjam, UserID, IDRuangan)
                VALUES ('$this->jamPinjam', '$this->lamaPinjam','$this->jamSelesai', '$this->keperluan', '$this->tglSelesai', '$this->tglPinjam', '$this->UserID', '$this->IDRuangan')";

                    $this->hasil = mysqli_query($this->connection, $sql);
                } elseif ($tglakh < $tglawal || $tglakh > $tglawal) {
                    echo "<script> alert('Tanggal Tidak Valid!'); </script>";
                } elseif ($jmk < $jmp) {
                    echo "<script> alert('Jam Tidak Valid!'); </script>";
                } elseif ($tglawal < $tglakh && $jmk > $jmp) {
                    $sql = "INSERT INTO peminjaman_ruangan (jamPinjam, lamaPinjam, jamSelesai, keperluan, tglSelesai, tglPinjam, UserID, IDRuangan)
                VALUES ('$this->jamPinjam', '$this->lamaPinjam','$this->jamSelesai', '$this->keperluan', '$this->tglSelesai', '$this->tglPinjam', '$this->UserID', '$this->IDRuangan')";

                    $this->hasil = mysqli_query($this->connection, $sql);
                } else {
                    $sql = "INSERT INTO peminjaman_ruangan (jamPinjam, lamaPinjam, jamSelesai, keperluan, tglSelesai, tglPinjam, UserID, IDRuangan)
                VALUES ('$this->jamPinjam', '$this->lamaPinjam','$this->jamSelesai', '$this->keperluan', '$this->tglSelesai', '$this->tglPinjam', '$this->UserID', '$this->IDRuangan')";

                    $this->hasil = mysqli_query($this->connection, $sql);
                }
            } else {
                echo "<script> alert('Sudah Di Booking!'); </script>";
            }
        } else {
            echo "<script> alert('Sudah Di Booking Pada jam Tersebut!, silahkan isi pada jam lain'); </script>";
        }

        if ($this->jamPinjam < 0)
            echo "<script> alert('Password tidak match!'); </script>";
        else

        if ($this->hasil)
            $this->message = 'Data berhasil ditambahkan';
        else
            $this->message = 'Data gagal ditambahkan';

        return $this->connection->insert_id;
    }

    public function SetujuiPeminjaman()
    {
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan SET persetujuan = 'Disetujui' WHERE IDPeminjaman = '$this->IDPeminjaman'";

        $this->hasil = mysqli_query($this->connection, $sql);

        if ($this->hasil)
            $this->message = 'Persetujuan peminjaman berhasil disetujui';
        else
            $this->message = 'Peminjaman gagal untuk disetujui';
    }

    public function SetujuiPeminjamanKabid()
    {
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan SET persetujuan = 'Persetujuan 1' WHERE IDPeminjaman = '$this->IDPeminjaman'";

        $this->hasil = mysqli_query($this->connection, $sql);

        if ($this->hasil)
            $this->message = 'Kepala Divisi berhasil menyetujui';
        else
            $this->message = 'Peminjaman gagal untuk disetujui';
    }

    public function TolakPeminjaman()
    {
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan SET persetujuan = 'Tidak disetujui' WHERE IDPeminjaman = '$this->IDPeminjaman'";

        $this->hasil = mysqli_query($this->connection, $sql);

        if ($this->hasil)
            $this->message = 'Persetujuan peminjaman telah ditolak';
        else
            $this->message = 'Peminjaman gagal untuk ditolak';
    }

    public function BatalkanPeminjaman()
    {
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan SET persetujuan = 'Belum disetujui' WHERE IDPeminjaman = '$this->IDPeminjaman'";

        $this->hasil = mysqli_query($this->connection, $sql);

        if ($this->hasil)
            $this->message = 'Persetujuan peminjaman telah ditolak';
        else
            $this->message = 'Peminjaman gagal untuk ditolak';
    }

    public function UpdatePeminjaman()
    {
        $this->connect();
        $sql = "UPDATE peminjaman_ruangan
                SET jamPinjam = '$this->nama',
                    lamaPinjam = '$this->email',
                    selesaiPinjam = '$this->password',
                    keperluan = '$this->alamat',
                    tglSelesai = '$this->role',
                    tglPinjam = '$this->noTelp'
                WHERE IDPeminjaman = '$this->IDPeminjaman' AND persetujuan = '' AND tglPersetujuan = ''";

        $this->hasil = mysqli_query($this->connection, $sql);

        if ($this->hasil)
            $this->message = 'Data peminjaman ruangan berhasil diubah';
        else
            $this->message = 'Data gagal diubah';
    }

    public function DeletePeminjaman()
    {
        $this->connect();
        $sql = "DELETE FROM peminjaman_ruangan WHERE IDPeminjaman = '$this->IDPeminjaman'";
        $this->hasil = mysqli_query($this->connection, $sql);

        if ($this->hasil)
            $this->message = 'Data berhasil dihapus';
        else
            $this->message = 'Data gagal dihapus';
    }

    public function SelectAllPeminjamanUser($kategori = null)
    {
        $this->connect();
        $userID = $_SESSION["UserID"];
        if (!$kategori)
            $sql = "SELECT pr.*, r.namaRuangan FROM peminjaman_ruangan pr JOIN ruangan r ON pr.IDRuangan = r.IDRuangan AND pr.UserID = '$userID' ORDER BY IDPeminjaman DESC";
        else {
            $sql = "SELECT pr.*, r.namaRuangan FROM peminjaman_ruangan pr JOIN ruangan r ON pr.IDRuangan = r.IDRuangan WHERE r.namaRuangan = '$kategori' AND pr.UserID = '$userID' ORDER BY IDPeminjaman DESC";
        }
        $result = mysqli_query($this->connection, $sql);

        $arrResult = array();
        $count = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
                $objPeminjaman = new Peminjaman_Ruangan();
                $objPeminjaman->IDPeminjaman = $data['IDPeminjaman'];
                $objPeminjaman->ruangan->namaRuangan = $data['namaRuangan'];
                $objPeminjaman->UserID = $data['UserID'];
                $objPeminjaman->tglPinjam = $data['tglPinjam'];
                $objPeminjaman->tglSelesai = $data['tglSelesai'];
                $objPeminjaman->jamPinjam = $data['jamPinjam'];
                $objPeminjaman->jamSelesai = $data['jamSelesai'];
                $objPeminjaman->keperluan = $data['keperluan'];
                $objPeminjaman->persetujuan = $data['persetujuan'];
                $objPeminjaman->tglPersetujuan = $data['tglPersetujuan'];

                $arrResult[$count] = $objPeminjaman;
                $count++;
            }
        }

        return $arrResult;
    }

    public function SelectAllPeminjaman($kategori = null)
    {
        $this->connect();

        if (!$kategori)
            $sql = "SELECT u.*, pr.*, r.* FROM userruangan u JOIN peminjaman_ruangan pr JOIN ruangan r ON pr.IDRuangan = r.IDRuangan WHERE u.UserID = pr.UserID ORDER BY IDPeminjaman DESC";
        else {
            $sql = "SELECT u.*, pr.*, r.* FROM userruangan u JOIN peminjaman_ruangan pr JOIN ruangan r ON pr.IDRuangan = r.IDRuangan WHERE u.UserID = pr.UserID AND r.namaRuangan = '$kategori' ORDER BY IDPeminjaman DESC";
        }
        $result = mysqli_query($this->connection, $sql);

        $arrResult = array();
        $count = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_array($result)) {
                $objPeminjaman = new Peminjaman_Ruangan();
                $objPeminjaman->user->nama = $data['nama'];

                $objPeminjaman->user->email = $data['email'];
                $objPeminjaman->IDPeminjaman = $data['IDPeminjaman'];
                $objPeminjaman->user->UserID = $data['email'];
                $objPeminjaman->IDRuangan = $data['IDRuangan'];
                $objPeminjaman->ruangan->namaRuangan = $data['namaRuangan'];
                $objPeminjaman->UserID = $data['UserID'];
                $objPeminjaman->tglPinjam = $data['tglPinjam'];
                $objPeminjaman->tglSelesai = $data['tglSelesai'];
                $objPeminjaman->jamPinjam = $data['jamPinjam'];
                $objPeminjaman->jamSelesai = $data['jamSelesai'];
                $objPeminjaman->keperluan = $data['keperluan'];
                $objPeminjaman->persetujuan = $data['persetujuan'];
                $objPeminjaman->tglPersetujuan = $data['tglPersetujuan'];

                $arrResult[$count] = $objPeminjaman;
                $count++;
            }
        }

        return $arrResult;
    }

    public function SelectOnePeminjaman()
    {
        $this->connect();
        $sql = "SELECT * FROM peminjaman_ruangan WHERE IDPeminjaman='$this->IDPeminjaman'";
        $resultOne = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($resultOne) == 1) {
            $this->hasil = true;
            $data = mysqli_fetch_assoc($resultOne);
            $this->jamPinjam  = $data['jamPinjam'];
            $this->IDRuangan = $data['IDRuangan'];
            $this->UserID = $data['UserID'];
            $this->tglPinjam = $data['tglPinjam'];
            $this->tglSelesai = $data['tglSelesai'];
            $this->jamPinjam = $data['jamPinjam'];
            $this->jamSelesai = $data['jamSelesai'];
            $this->keperluan = $data['keperluan'];
            $this->persetujuan = $data['persetujuan'];
            $this->tglPersetujuan = $data['tglPersetujuan'];
        }
    }

    public function SelectSepuluhPeminjaman(){
        $this->connect();
        $sql = "SELECT u.*, pr.*, r.* FROM userruangan u JOIN peminjaman_ruangan pr JOIN ruangan r ON pr.IDRuangan = r.IDRuangan WHERE u.UserID = pr.UserID AND  tglSelesai BETWEEN CURDATE() - INTERVAL 0 DAY AND CURDATE() AND persetujuan = 'Disetujui'";
        $result = mysqli_query($this->connection, $sql);

        $arrResult = Array();
        $count=0;

        if(mysqli_num_rows($result) > 0){
            while ($data = mysqli_fetch_array($result)){
                $objPeminjaman = new Peminjaman_Ruangan();
                $objPeminjaman->user->nama=$data['nama'];
                $objPeminjaman->IDPeminjaman=$data['IDPeminjaman'];
                $objPeminjaman->ruangan->namaRuangan=$data['namaRuangan'];
                $objPeminjaman->UserID=$data['UserID'];
                $objPeminjaman->tglPinjam=$data['tglPinjam'];
                $objPeminjaman->tglSelesai=$data['tglSelesai'];
                $objPeminjaman->jamPinjam=$data['jamPinjam'];
                $objPeminjaman->jamSelesai=$data['jamSelesai'];
                $objPeminjaman->keperluan=$data['keperluan'];
                $objPeminjaman->persetujuan=$data['persetujuan'];
                $objPeminjaman->tglPersetujuan=$data['tglPersetujuan'];
                
                $arrResult[$count] = $objPeminjaman;
                $count++;
            }
        }
        
        return $arrResult;
    }
}