<?php
// Bagian Index
if (isset($_GET['module'])	==''){
  include "modul/mod_home/home.php";
}

// Bagian Home
elseif ($_GET['module'] =='home'){
  include "modul/mod_home/home.php";
}

// Bagian Penyakit
elseif ($_GET['module']=='penyakit'){
  include "modul/mod_penyakit/Penyakit.php";
}

// Bagian Komoditi
elseif ($_GET['module']=='komoditi'){
  include "modul/mod_komoditi/komoditi.php";
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

// Bagian Pemetaan
elseif ($_GET['module']=='pemetaan'){
  include "modul/mod_pemetaan/pemetaan.php";
}

// Bagian Pengendalian
elseif ($_GET['module']=='pengendalian'){
  include "modul/mod_pengendalian/pengendalian.php";
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

// Bagian Pesan
elseif ($_GET['module']=='pesan'){
  include "modul/mod_pesan/pesan.php";
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
