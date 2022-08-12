<?php

    require_once('./class/class.Peminjaman.php');
    require_once('./class/class.Register.php');
    require_once('./class/class.Mail.php');

    if(isset($_GET['IDPeminjaman'])){
        $objPeminjaman = new Peminjaman_Ruangan(); 
        $objRegister = new Register();
        $IDPeminjaman = $_GET['IDPeminjaman'];
        $objRegister->SelectOneMemberByID($IDPeminjaman);
        $objPeminjaman->IDPeminjaman = $IDPeminjaman;
        $objPeminjaman->TolakPeminjaman();

        if($objPeminjaman->hasil){			
            $message =  file_get_contents('templateemail.html');  					 
            $header = '<img src="cid:bintan" width="200"
            height="130">';
            $body = '<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                        <table id="pinjam" >
                        <tr>
                            <td colspan="3" align="center">
                                <h1>Peminjaman Ruangan Ditolak</h1>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">
                                <h2>Form Penggunaan Ruangan</h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                Persetujuan
                            </td>
                            <td align="center">
                                :
                            </td>
                            <td align="left">
                                Ditolak
                            </td>
                        </tr></br>
                    </span>';
                    
            $footer ='Peminjaman ruangan telah ditolak, silakan login untuk memeriksa peminjaman ruangan pada hari, tanggal, dan jam lainnya';
                                        
            $message = str_replace("#header#",$header,$message);
            $message = str_replace("#body#",$body,$message);
            $message = str_replace("#footer#",$footer,$message);
                                             
            $objMail = new Mail();
            $objMail->SendMail($objRegister->email, $objRegister->nama, 'Peminjaman Ruangan Ditolak', $message);	
            echo "<script> alert('Penolakan Peminjaman Ruangan Ruangan Berhasil'); </script>";
            echo '<script> window.location="dashboardAdmin.php?p=adminListPeminjaman"; </script>'; 				
        }

        echo "<script> alert('$objPeminjaman->message'); </script>";
        echo "<script> window.location = 'dashboardAdmin.php?p=adminListPeminjaman' </script>";
    } else{
        echo '<script> window.history.back() </script>';
    }

?>