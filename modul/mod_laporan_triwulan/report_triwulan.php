<?php
	$nala="Laporan Triwulan";
	include("../../mpdf60/mpdf.php");
	$mpdf=new mPDF('utf-8','A4');//,0,'',10,10,5,1,1,1,'');
	ob_start();
    include_once "../../../config/koneksi.php";
    $id  = $_POST['id'];
    $ida = $_POST['ida'];
?>
<link rel="stylesheet" href="../../css/adminstyle.css" type="text/css" />
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <img src="../../images/header.jpg" alt="header" class="img-responsive" width="780px" height="120px" usemap="#Map" />
        </div>
    </div><br />
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <h4 class="text-center">LAPORAN PEMETAAN TRIWULAN - KOMODITI</h4>
            <h5><?php echo $id." / ".$ida ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" align="center" width="100%">
                    <thead>
                        <tr class="success text-uppercase">
                            <th>No</th>
                            <th>Id</th>
                            <th>Komoditi</th>
                            <th>Penyakit</th>
                            <th>Kabupaten</th>
                            <th>luas</th>
                            <th>serangan ringan</th>
                            <th>serangan berat</th>
                            <th>jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query=mysqli_query($koneksi, "SELECT * FROM tpemetaan WHERE nama_triwulan='$id' AND tahun='$ida' ORDER BY id_pemetaan ASC");
                            $no=1;
                            while ($data=mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $data["id_pemetaan"] ?></td>
                            <td><?php echo $data["nama_komoditi"] ?></td>
                            <td><?php echo $data["nama_penyakit"] ?></td>
                            <td><?php echo $data["nama_kabupaten"] ?></td>
                            <td align="center"><?php echo $data["luas_komoditas"] ?></td>
                            <td align="center"><?php echo $data["luas_serangan_ringan"] ?></td>
                            <td align="center"><?php echo $data["luas_serangan_berat"] ?></td>
                            <td align="center"><?php echo $data["jumlah"] ?></td>
                        </tr>
                        <?php
                            $no++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    $html=ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML($html);
    $mpdf->Output($nala.".pdf",I);
    exit;
?>
