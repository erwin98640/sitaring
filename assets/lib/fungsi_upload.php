<?php
	function UploadGambar($fupload_name){
	  //direktori file
	  $vdir_upload = "./assets/images/kegiatan/";
	  $vfile_upload = $vdir_upload . $fupload_name;

	  //Simpan gambar dalam ukuran sebenarnya
	  move_uploaded_file($_FILES["image_1"]["tmp_name"], $vfile_upload);

	  //identitas file asli
	  $im_src = imagecreatefromjpeg($vfile_upload);
	  $src_width = imageSX($im_src);
	  $src_height = imageSY($im_src);

	  //Simpan dalam versi small 200 pixel
	  //Set ukuran gambar hasil perubahan
	  // $dst_width  = 200;
	  // $dst_height = ($dst_width/$src_width)*$src_height;

	  $dst_height = 200;
	  $med_height = 500;
	  // $dst_width  = ($dst_height/$src_height)*$src_width;
	  $dst_width  = 200;
	  $med_width  = 500;

	  //proses perubahan ukuran
	  $im = imagecreatetruecolor($dst_width,$dst_height);
	  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	  //Simpan gambar
	  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);

	  $ime = imagecreatetruecolor($med_width,$med_height);
	  imagecopyresampled($ime, $im_src, 0, 0, 0, 0, $med_width, $med_height, $src_width, $src_height);
	  imagejpeg($ime,$vdir_upload . "medium_" . $fupload_name);
	}
?>
