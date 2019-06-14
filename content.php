<?php
// Bagian Index
if (isset($_GET['module'])	==''){
  include "modul/mod_home/home.php";
}

// Bagian Home
elseif ($_GET['module'] =='home'){
  include "modul/mod_home/home.php";
}

// Bagian Pekerjaan
elseif ($_GET['module']=='pekerjaan'){
  include "modul/mod_pekerjaan/pekerjaan.php";
}

// Bagian Bidang
elseif ($_GET['module']=='bidang'){
  if (!empty($_SESSION['username']) AND empty($_SESSION['password'])){
    include "modul/mod_bidang/bidang.php";
  } else {
    header ("location:./index.php");
  }
}

// Bagian Pemetaan
elseif ($_GET['module']=='pemetaan'){
  if (!empty($_SESSION['username']) AND empty($_SESSION['password'])){
    include "modul/mod_pemetaan/pemetaan.php";
  } else {
    header ("location:./index.php");
  }
}

// Bagian Satuan
elseif ($_GET['module']=='satuan'){
  if (!empty($_SESSION['username']) AND empty($_SESSION['password'])){
    include "modul/mod_satuan/satuan.php";
  } else {
    header ("location:./index.php");
  }
}

// Bagian Program
elseif ($_GET['module']=='program'){
  if (!empty($_SESSION['username']) AND empty($_SESSION['password'])){
    include "modul/mod_program/program.php";
  } else {
    header ("location:./index.php");
  }
}

// Bagian Jenis Pengadaan
elseif ($_GET['module']=='jenis_pengadaan'){
  if (!empty($_SESSION['username']) AND empty($_SESSION['password'])){
    include "modul/mod_jenis_pengadaan/jenis_pengadaan.php";
  } else {
    header ("location:./index.php");
  }
}

// Bagian Login
elseif ($_GET['module']=='login'){
  if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
    include "modul/mod_login/login.php";
  } else {
    header ("location:./index.php");
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
