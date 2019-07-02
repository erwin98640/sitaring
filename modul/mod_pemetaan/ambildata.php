<?php  include "../../config/koneksi.php";
    $data = mysqli_query($koneksi, "SELECT * FROM data_pekerjaan");

    $json = '{"wilayah": {';
    $json .= '"petak":[ ';
    while($x = mysqli_fetch_array($data)){
        $json .= '{';
        $json .= '"id":"'.$x['id_pekerjaan'].'",
            "x":"'.$x['koordinat_x'].'",
            "y":"'.$x['koordinat_y'].'",
            "kode":"'.$x['kode'].'",
            "program":"'.$x['program'].'",
            "kegiatan":"'.$x['kegiatan'].'",
            "nama_pekerjaan":"'.$x['nama_pekerjaan'].'",
            "tahun_perolehan":"'.$x['tahun_perolehan'].'",
            "realisasi_keuangan":"'.$x['realisasi_keuangan'].'",
            "realisasi_fisik":"'.$x['realisasi_fisik'].'",

            "jenis":"kelapa"
        },';
    }
    $json = substr($json,0,strlen($json)-1);
    $json .= ']';

    $json .= '}}';
    echo $json;
?>
