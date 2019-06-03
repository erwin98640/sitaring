<?php
// Bagian Index
if (isset($_GET['module'])	==''){
  include "modul/mod_home/home.php";
}

// Bagian Home
elseif ($_GET['module'] =='home'){
  include "modul/mod_home/home.php";
}

// Bagian Bidang
elseif ($_GET['module']=='bidang'){
  include "modul/mod_bidang/bidang.php";
}

// Bagian Pemetaan
elseif ($_GET['module']=='pemetaan'){
  include "modul/mod_pemetaan/pemetaan.php";
}

// Bagian Satuan
elseif ($_GET['module']=='satuan'){
  include "modul/mod_satuan/satuan.php";
}

// Bagian Jenis Pengadaan
elseif ($_GET['module']=='jenis_pengadaan'){
  include "modul/mod_jenis_pengadaan/jenis_pengadaan.php";
}






// Bagian Penyakit
elseif ($_GET['module']=='penyakit'){
  include "modul/mod_penyakit/Penyakit.php";
}

// Bagian Kabupaten
elseif ($_GET['module']=='kabupaten'){
  include "modul/mod_kabupaten/kabupaten.php";
}

// Bagian Triwulan
elseif ($_GET['module']=='triwulan'){
  include "modul/mod_triwulan/triwulan.php";
}

// Bagian Luas Komoditi
elseif ($_GET['module']=='luaskomoditi'){
  include "modul/mod_luaskomoditi/luaskomoditi.php";
}

// Bagian Laporan Triwulan
elseif ($_GET['module']=='laporan_triwulan'){
  include "modul/mod_laporan_triwulan/laporan_triwulan.php";
}

// Bagian Laporan Pengendalian
elseif ($_GET['module']=='laporan_pengendalian'){
  include "modul/mod_pengendalian_triwulan/laporan_pengendalian.php";
}

// Bagian Grafik
elseif ($_GET['module']=='grafik'){
  include "modul/mod_grafik/grafik.php";
}

// Bagian Pengaturan
elseif ($_GET['module']=='pengaturan'){
  include "modul/mod_pengaturan/pengaturan.php";
}

// Bagian ambil database
elseif ($_GET['module']=='ambildata'){
  include "modul/mod_pemetaan/ambildata.php";
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
