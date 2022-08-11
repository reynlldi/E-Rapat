<?php ob_start();
require("../inc.koneksi.php");
require('../vendor/autoload.php');
// require_once('../html2pdf/html2pdf.class.php');
require_once('../class/class.Register.php');

use Spipu\Html2Pdf\Html2Pdf;

$year = date("Y");
$judul = 'Laporan Data User Sistem E-Rapat ' . $year;
$content = '<h3 style="text-align: center;"><b>' . $judul . '</b></h3>';

$objRegister = new Register();
$arrayResult = $objRegister->SelectAllMember();

$content .= '<table style="border: 1px solid #ddd; border-collapse: collapse;" align="center">';
$content .= '<tr>
                    <th style="background-color: #007bff; color: white; padding: 10px;">No.</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Name</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Email</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Alamat</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Role</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">No. Telp</th>
                    <th style="background-color: #007bff; color: white; padding: 10px;">Gender</th>
                </tr>';

if (count($arrayResult) == 0) {
    $content .= '<tr><td colspan="7" style="text-align: center;">Tidak ada data!</td></tr>';
} else {
    $no = 1;
    foreach ($arrayResult as $dataUser) {
        if ($dataUser->role == 'Staf' or $dataUser->role == 'Admin') {
            $content .= '<tr>';
            $content .= '<td style="border: 1px solid #ddd; padding: 10px;">' . $no . '</td>';
            $content .= '<td style="border: 1px solid #ddd; padding: 10px;">' . $dataUser->nama . '</td>';
            $content .= '<td style="border: 1px solid #ddd; padding: 10px;">' . $dataUser->email . '</td>';
            $content .= '<td style="border: 1px solid #ddd; padding: 10px; width:110px">' . $dataUser->alamat . '</td>';
            $content .= '<td style="border: 1px solid #ddd; padding: 10px;">' . $dataUser->role . '</td>';
            $content .= '<td style="border: 1px solid #ddd; padding: 10px;">' . $dataUser->noTelp . '</td>';
            $content .= '<td style="border: 1px solid #ddd; padding: 10px;">' . $dataUser->gender . '</td>';
            $content .= '</tr>';
            $no++;
        }
    }
}

$content .= '</table>';

$html2pdf = new HTML2PDF('L', 'A4', 'fr');
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
ob_end_clean();
$html2pdf->Output($judul . '.pdf');