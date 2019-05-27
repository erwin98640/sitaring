<?php
    $data = mysqli_query($koneksi, "SELECT * FROM tpemetaan");

    $json = '{"wilayah": {';
    $json .= '"petak":[ ';
    while($x = mysqli_fetch_array($data)){
        $json .= '{';
        $json .= '"id":"'.$x['id_pemetaan'].'",
            "x":"'.$x['koordinat_x'].'",
            "y":"'.$x['koordinat_y'].'",
    		
            "jenis":"'.$x['jenis'].'"
        },';
    }
    $json = substr($json,0,strlen($json)-1);
    $json .= ']';

    $json .= '}}';
    echo $json;
?>
