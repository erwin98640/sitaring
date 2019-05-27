<?php
	$nala="Laporan Pengendalian";
	include("../../mpdf60/mpdf.php");
	$mpdf=new mPDF('utf-8','A4');//,0,'',10,10,5,1,1,1,'');
	ob_start();
    include_once "../../../config/koneksi.php";
    $id =$_POST['id'];
    $ida=$_POST['ida'];
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
            <h4 class="text-center">LAPORAN PENGENDALIAN HAMA / PENYAKIT</h4>
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
                            <th>Triwulan</th>
                            <th>Komoditi</th>
                            <th>Penyakit</th>
                            <th>Kabupaten</th>
                            <th>Pengendalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query=mysqli_query($koneksi, "SELECT * FROM tpengendalian WHERE nama_triwulan='$id' AND nama_komoditi='$ida' ORDER BY id_pengendalian ASC");
                            $no=1;
                            while ($data=mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <?php foreach ($data as $key){ ?>
                            <td><?php echo $key ?></td>
                            <?php } ?>
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
