<?php if (isset($_POST['submit'])) {
		$lokasi_file		= $_FILES['image_1']['tmp_name'];
		$image_1			= $_FILES['image_1']['name'];

		$kode				= $_POST['kode'];
		$program			= $_POST['program'];
		$kegiatan			= $_POST['kegiatan'];
		$nama_pekerjaan		= $_POST['nama_pekerjaan'];
		$tahun_perolehan	= $_POST['tahun_perolehan'];
		$pagu_anggaran		= $_POST['pagu_anggaran'];
		$nomor_kontrak		= $_POST['nomor_kontrak'];
		$nilai_kontrak		= $_POST['nilai_kontrak'];
		$pelaksana			= $_POST['pelaksana'];
		$panjang			= $_POST['panjang'];
		$lebar				= $_POST['lebar'];
		$tinggi				= $_POST['tinggi'];
		$satuan				= $_POST['satuan'];
		$jenis_pengadaan	= $_POST['jenis_pengadaan'];
		$waktu_pelaksanaan	= $_POST['waktu_pelaksanaan'];
		$status_kepemilikan	= $_POST['status_kepemilikan'];
		$harga_perolehan	= $_POST['harga_perolehan'];
		$realisasi_keuangan	= $_POST['realisasi_keuangan'];
		$realisasi_fisik	= $_POST['realisasi_fisik'];
		$lokasi 			= $_POST['lokasi'];
		$koordinat_x		= $_POST['koordinat_x'];
		$koordinat_y		= $_POST['koordinat_y'];
		$penanggung_jawab	= $_POST['penanggung_jawab'];
		$image_2			= "b";
		$image_3			= "a";
		// if ($image_1=="" OR $image_2=="" OR $image_3=="") {
		if ($image_1=="") { ?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php } else {
			UploadGambar($image_1);
			mysqli_query($koneksi, "INSERT INTO data_pekerjaan (kode, program, kegiatan, nama_pekerjaan, tahun_perolehan, pagu_anggaran, nomor_kontrak, nilai_kontrak, pelaksana, panjang, lebar, tinggi, satuan, jenis_pengadaan, waktu_pelaksanaan, status_kepemilikan, harga_perolehan, realisasi_keuangan, realisasi_fisik, lokasi, koordinat_x, koordinat_y, penanggung_jawab, image_1, image_2, image_3) VALUES ('$kode','$program','$kegiatan', '$nama_pekerjaan', '$tahun_perolehan','$pagu_anggaran','$nomor_kontrak', '$nilai_kontrak', '$pelaksana', '$panjang', '$lebar', '$tinggi', '$satuan', '$jenis_pengadaan', '$waktu_pelaksanaan', '$status_kepemilikan', '$harga_perolehan', '$realisasi_keuangan', '$realisasi_fisik', '$lokasi', '$koordinat_x', '$koordinat_y', '$penanggung_jawab', '$image_1', '$image_2', '$image_3')"); ?>
					<script language="javascript">document.location.href="?module=pemetaan"</script>
		<?php }
	}

	if(isset($_GET['mode'])=='delete'){
		$id_pemetaan=$_GET['id_pemetaan'];
		mysqli_query($koneksi, "delete from tpemetaan where id_pemetaan='$id_pemetaan'");
		?>
			<script language="javascript">document.location.href="?module=pemetaan"</script>
		<?php
	}
switch (isset($_GET['act'])) { default: ?>

<script type="text/javascript" src="./assets/js/jquery-1.12.3.js"></script>
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFpkPVjM26Py4C4pDe9RiCVWPl4s_pXrw&callback=initMap"></script>
<script type="text/javascript">
	var peta;
	var jenis = "kelapa";
	
	function carikordinat(){
	    var jakarta = new google.maps.LatLng(-2.8497764266656023, 115.49523923546076);
	    var petaoption = {
	        zoom: 8,
	        center: jakarta,
	        mapTypeId: google.maps.MapTypeId.ROADMAP
	        };
	    peta = new google.maps.Map(document.getElementById("kanvaspeta"),petaoption);
	    google.maps.event.addListener(peta,'click',function(event){
	        kasihtanda(event.latLng);
	    });
	    ambildatabase('awal');
		
		/*untuk tgl*/
		// new JsDatePick({
		// 	useMode:2,
		// 	target:"tgl",
		// 	dateFormat:"%Y-%m-%d"
		// });
	}

	function kasihtanda(lokasi){
	    set_icon(jenis);
	    tanda = new google.maps.Marker({
	            position: lokasi,
	            map: peta,
	            icon: gambar_tanda,
    			scaleSize: 37
	    });
	    $("#x").val(lokasi.lat());
	    $("#y").val(lokasi.lng());

	}

	function set_icon(jenisnya){
	    switch(jenisnya){
	        case "kelapa":
	            gambar_tanda = './assets/images/location.png';
	            break;
	        case "kelapa_sawit":
	            gambar_tanda = './assets/images/kelapa_sawit.png';
	            break;
	        case  "karet":
	            gambar_tanda = './assets/images/karet.png';
	            break;
	    }
	}

	function setjenis(jns){
	    jenis = jns;
	}

	function ambildatabase(akhir){
		// url = "modul/mod_pemetaan/ambildata.php";
		// url = "?module=ambildata.php";
		url = "ambildata.php";
		$.ajax({
			url: url,
			dataType: 'json',
			cache: false,
			success: function(msg){
				for(i=0;i<msg.wilayah.petak.length;i++){
					
					set_icon(msg.wilayah.petak[i].jenis);
					var point = new google.maps.LatLng(
						parseFloat(msg.wilayah.petak[i].x),
						parseFloat(msg.wilayah.petak[i].y));
					tanda = new google.maps.Marker({
						position: point,
						map: peta,
						icon: gambar_tanda
					});
				}
			}
		});
	}

	function setinfo(petak, nomor){
		google.maps.event.addListener(petak, 'click', function() {
		});
	}

</script>
	<form action="?module=pemetaan" enctype="multipart/form-data" method="POST">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA PEMETAAN</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label>ICON PEKERJAAN</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="./assets/images/location.png">
					<input type="radio" checked name="jenis" value="kelapa" onclick="setjenis(this.value)"> Bangunan
					<!-- <img src="images/kelapa_sawit.png">
					<input type="radio" name="jenis" value="kelapa_sawit" onclick="setjenis(this.value)"> Kelapa Sawit&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="images/karet.png">
					<input type="radio" name="jenis" value="karet" onclick="setjenis(this.value)"> Karet&nbsp;&nbsp;&nbsp;&nbsp; -->
				</div>
			</div>
			<div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
				<div class="form-group">
					<label>KODE</label>
					<input type="text" name="kode" class="form-control" placeholder="Input Kode">
				</div>
				<div class="form-group">
					<label>PROGRAM</label>
					<select name="program" class="form-control">
						<?php $program=mysqli_query($koneksi, "SELECT * FROM data_program ORDER BY id_program ASC");
						while ($DProgram=mysqli_fetch_object($program)) { ?>
						<option value="<?php echo $DProgram->id_program ?>"><?php echo $DProgram->nama_program ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>KEGIATAN</label>
					<input type="text" name="kegiatan" class="form-control" placeholder="Input Kegiatan">
				</div>
				<div class="form-group">
					<label>NAMA PEKERJAAN</label>
					<input type="text" name="nama_pekerjaan" class="form-control" placeholder="Input Nama Pekerjaan">
				</div>
				<div class="form-group">
					<label>TAHUN PEROLEHAN</label>
					<input type="number" name="tahun_perolehan" class="form-control" placeholder="Input Tahun Perolehan">
				</div>
				<div class="form-group">
					<label>PAGU ANGGARAN</label>
					<input type="number" name="pagu_anggaran" class="form-control" placeholder="Input Pagu Anggaran">
				</div>
			</div>
			<div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
				<div class="form-group">
					<label>NOMOR</label>
					<input type="text" name="nomor_kontrak" class="form-control" placeholder="Input Nomor">
				</div>
				<div class="form-group">
					<label>NILAI KONTRAK</label>
					<input type="number" name="nilai_kontrak" class="form-control" placeholder="Input Nilai Kontrak">
				</div>
				<div class="form-group">
					<label>PELAKSANA</label>
					<input type="text" name="pelaksana" class="form-control" placeholder="Input Pelaksana">
				</div>
				<div class="form-group">
					<label>JENIS PENGADAAN</label>
					<select name="jenis_pengadaan" class="form-control">
						<?php $jenis=mysqli_query($koneksi, "SELECT * FROM data_jenis_pengadaan ORDER BY jenis_pengadaan ASC");
						while ($DJenis=mysqli_fetch_object($jenis)) { ?>
						<option value="<?php echo $DJenis->id_jenis_pengadaan ?>"><?php echo $DJenis->jenis_pengadaan ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>WAKTU PELAKSANAAN</label>
					<input type="text" name="waktu_pelaksanaan" class="form-control" placeholder="Input Waktu Pelaksanaan">
				</div>
			</div>
			<div class="col-lg-4 col-xs-12 col-md-6 col-sm-6">
				<div class="form-group">
					<label>STATUS KEPEMILIKAN</label>
					<input type="text" name="status_kepemilikan" class="form-control" placeholder="Input Status Kepemilikan">
				</div>
				<div class="form-group">
					<label>HARGA PEROLEHAN</label>
					<input type="number" name="harga_perolehan" class="form-control" placeholder="Input Harga Perolehan">
				</div>
				<div class="form-group">
					<label>REALISASI KEUANGAN</label>
					<input type="number" name="realisasi_keuangan" class="form-control" placeholder="Input Realisasi Keuangan">
				</div>
				<div class="form-group">
					<label>REALISASI FISIK</label>
					<input type="number" name="realisasi_fisik" class="form-control" placeholder="Input Realisasi Fisik">
				</div>
				<div class="form-group">
					<label>LOKASI</label>
					<input type="text" name="lokasi" class="form-control" placeholder="Input Lokasi">
				</div>
				<div class="form-group">
					<label>PENANGGUNG JAWAB</label>
					<select name="penanggung_jawab" class="form-control">
						<?php $bidang=mysqli_query($koneksi, "SELECT * FROM data_bidang ORDER BY nama_pendek_bidang ASC");
						while ($DBidang=mysqli_fetch_object($bidang)) { ?>
						<option value="<?php echo $DBidang->id_bidang ?>"><?php echo $DBidang->nama_pendek_bidang ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<div class="form-group row">
					<label class="col-lg-12">LUAS</label>
					<div class="col-md-3">
						<input type="number" name="panjang" class="form-control" placeholder="Panjang">
					</div>
					<div class="col-md-3">
						<input type="number" name="lebar" class="form-control" placeholder="Lebar">
					</div>
					<div class="col-md-3">
						<input type="number" name="tinggi" class="form-control" placeholder="Tinggi">
					</div>
					<div class="col-md-3">
						<select name="satuan" class="form-control">
							<?php $satuan=mysqli_query($koneksi, "SELECT * FROM data_satuan ORDER BY satuan ASC");
							while ($DSatuan=mysqli_fetch_object($satuan)) { ?>
							<option value="<?php echo $DSatuan->id_satuan ?>"><?php echo $DSatuan->satuan ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<div class="form-group row">
					<div class="col-lg-6">
						<label>KOORDINAT X</label>
						<input type="text" class="form-control" readonly="readonly" name="koordinat_x" id="x" value="" placeholder="koordinat x">
					</div>
					<div class="col-lg-6">
						<label>KOORDINAT Y</label>
						<input type="text" class="form-control" readonly="readonly" name="koordinat_y" id="y" value="" placeholder="koordinat y">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
				<div class="form-group row">
					<label class="col-lg-12">FOTO KEGIATAN</label>
					<div class="col-md-4">
						<input type="file" name="image_1" class="form-control" required>
					</div>
					<div class="col-md-4">
						<input type="file" name="image_2" class="form-control">
					</div>
					<div class="col-md-4">
						<input type="file" name="image_3" class="form-control">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<button type="submit" name="submit" class="btn btn-success pull-right" style="margin-left: 10px">Simpan</button>
		<input type="button" value="Cancel" class="btn btn-warning pull-right" onclick="return RefreshWindow();"/>
	</div>
	</form>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel" id="services">
					<div id="kanvaspeta" style="margin:0px auto; width:100%; height:95%; float:right; padding:0px;">
						<!--
						<script language="javascript" type="text/javascript">
							carikordinat(new google.maps.LatLng(-2.8497764266656023, 115.49523923546076));
						</script>
						-->
					</div>
				</div>
			</div>
		</div>
	</div><br />
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-hover table-striped table-bordered">
						<thead class="text-nowrap text-uppercase">
							<tr class="success">
								<th class="text-center" style="vertical-align: middle;" rowspan="3">No</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3" colspan="3">Kode / Program dan Kegiatan</th>
								<th class="text-center" style="vertical-align: middle;" colspan="2">Urian</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3">Pagu Anggaran</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3" colspan="2">Nomor dan Nilai Kontrak</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3">Pelaksana</th>
								<th class="text-center" style="vertical-align: middle;" colspan="5">Dimensi</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3">Jenis Pengadaan</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3">Waktu Pelaksanaan</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3">Status Kepemilikan</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3">Harga Perolehan <br>Rp.</th>
								<th class="text-center" style="vertical-align: middle;" colspan="3">Realisasi</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3">Lokasi</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3">Koordinat</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="3">Penanggung Jawab</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="4" width="40px">Aksi</th>
							</tr>
							<tr class="success">
								<th class="text-center" style="vertical-align: middle;" rowspan="2">Nama Pekerjaan</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">Thn Perolehan</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">Pjg</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">Lbr</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">T</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">Vol</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">Sat.</th>
								<th class="text-center" style="vertical-align: middle;" colspan="2">Keuangan</th>
								<th>Fisik</th>
							</tr>
							<tr class="success">
								<th class="text-center">Rp.</th>
								<th class="text-center">(%)</th>
								<th class="text-center">(%)</th>
							</tr>
							<tr class="danger">
								<th class="text-center">1</th>
								<th class="text-center" colspan="3">2</th>
								<th class="text-center">3</th>
								<th class="text-center">4</th>
								<th class="text-center">5</th>
								<th class="text-center" colspan="2">6</th>
								<th class="text-center">7</th>
								<th class="text-center">8</th>
								<th class="text-center">9</th>
								<th class="text-center">10</th>
								<th class="text-center">11</th>
								<th class="text-center">12</th>
								<th class="text-center">13</th>
								<th class="text-center">14</th>
								<th class="text-center">15</th>
								<th class="text-center">16</th>
								<th class="text-center">17</th>
								<th class="text-center">18</th>
								<th class="text-center">19</th>
								<th class="text-center">20</th>
								<th class="text-center">21</th>
								<th class="text-center">22</th>
							</tr>
						</thead>
						<tbody>
							<?php $query=mysqli_query($koneksi, "Select
							    data_pekerjaan.kode,
							    data_program.nama_program,
							    data_pekerjaan.kegiatan,
							    data_pekerjaan.nama_pekerjaan,
							    data_pekerjaan.tahun_perolehan,
							    data_pekerjaan.pagu_anggaran,
							    data_pekerjaan.nomor_kontrak,
							    data_pekerjaan.nilai_kontrak,
							    data_pekerjaan.pelaksana,
							    data_pekerjaan.panjang,
							    data_pekerjaan.lebar,
							    data_pekerjaan.tinggi,
							    data_satuan.satuan,
							    data_jenis_pengadaan.jenis_pengadaan,
							    data_pekerjaan.waktu_pelaksanaan,
							    data_pekerjaan.status_kepemilikan,
							    data_pekerjaan.harga_perolehan,
							    data_pekerjaan.realisasi_keuangan,
							    data_pekerjaan.realisasi_fisik,
							    data_pekerjaan.lokasi,
							    data_pekerjaan.koordinat_x,
							    data_pekerjaan.koordinat_y,
							    data_bidang.nama_pendek_bidang,
							    data_pekerjaan.image_1,
							    data_pekerjaan.image_2,
							    data_pekerjaan.image_3
							From
							    data_pekerjaan Inner Join
							    data_bidang On data_pekerjaan.penanggung_jawab = data_bidang.id_bidang Inner Join
							    data_jenis_pengadaan On data_pekerjaan.jenis_pengadaan = data_jenis_pengadaan.id_jenis_pengadaan Inner Join
							    data_program On data_pekerjaan.program = data_program.id_program Inner Join
							    data_satuan On data_pekerjaan.satuan = data_satuan.id_satuan ORDER BY id_pekerjaan");
								$no=1;
								while ($data=mysqli_fetch_object($query)) { ?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td><?php echo $data->kode ?></td>
								<td><?php echo $data->nama_program ?></td>
								<td><?php echo $data->kegiatan ?></td>
								<td><?php echo $data->nama_pekerjaan ?></td>
								<td class="text-center"><?php echo $data->tahun_perolehan ?></td>
								<td><?php echo "Rp ".number_format($data->pagu_anggaran) ?></td>
								<td><?php echo $data->nomor_kontrak ?></td>
								<td class="text-right"><?php echo "Rp ".number_format($data->nilai_kontrak) ?></td>
								<td><?php echo $data->pelaksana ?></td>
								<td class="text-center"><?php echo $data->panjang ?></td>
								<td class="text-center"><?php echo $data->lebar ?></td>
								<td class="text-center"><?php echo $data->tinggi ?></td>
								<td class="text-center"><?php echo $data->panjang*$data->lebar*$data->tinggi ?></td>
								<td><?php echo $data->satuan ?></td>
								<td><?php echo $data->jenis_pengadaan ?></td>
								<td><?php echo $data->waktu_pelaksanaan ?></td>
								<td><?php echo $data->status_kepemilikan ?></td>
								<td class="text-right"><?php echo "Rp ".number_format($data->harga_perolehan) ?></td>
								<td class="text-right"><?php echo "Rp ".number_format($data->realisasi_keuangan) ?></td>
								<td class="text-center"><?php echo ($data->realisasi_keuangan/$data->harga_perolehan)*100,"%" ?></td>
								<td class="text-center"><?php echo $data->realisasi_fisik."%" ?></td>
								<td><?php echo $data->lokasi ?></td>
								<td><?php echo $data->koordinat_x."|".$data->koordinat_y ?></td>
								<td><?php echo $data->nama_pendek_bidang ?></td>
								<td>
									<a href="?module=pemetaan&act=update&id_pekerjaan=<?php echo $data->id_pekerjaan ?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=pemetaan&mode=delete&id_pekerjaan=<?php echo $data->id_pekerjaan ?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
break;
case 'update':
$query=mysqli_query($koneksi, "SELECT * FROM tpengendalian WHERE id_pengendalian='$_GET[id_pengendalian]'");
$data=mysqli_fetch_array($query) ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="judul">
				<span>DATA PENGENDALIAN</span>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
			<form class="" action="?module=pengendalian" method="post">
				<input type="hidden" name="id" value="<?php echo $data[id_pengendalian]?>">
				<div class="form-group">
					<label for="">ID PENGENDALIAN</label>
					<input type="text" name="id_pengendalian" value="<?php echo $data[id_pengendalian]?>" placeholder="id pengendalian" class="form-control">
				</div>
				<div class="form-group">
					<label for="">TRIWULAN</label>
					<select class="form-control" name="nama_triwulan">
						<option value="<?php echo $data[nama_triwulan]?>"><?php echo $data[nama_triwulan]?></option>
						<?php
							$triwulan=mysqli_query($koneksi, "SELECT * FROM ttriwulan ORDER BY id_triwulan ASC");
							while ($diti=mysqli_fetch_array($triwulan)) {
						?>
						<option value="<?php echo $diti[nama_triwulan]?>"><?php echo $diti[nama_triwulan]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">NAMA KOMODITI</label>
					<select class="form-control" name="nama_komoditi">
						<option value="<?php echo $data[nama_komoditi]?>"><?php echo $data[nama_komoditi]?></option>
						<?php
							$komoditi=mysqli_query($koneksi, "SELECT * FROM tkomoditi ORDER BY id_komoditi ASC");
							while ($paten=mysqli_fetch_array($komoditi)) {
						?>
						<option value="<?php echo $paten[nama_komoditi]?>"><?php echo $paten[nama_komoditi]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">NAMA PENYAKIT</label>
					<select class="form-control" name="nama_penyakit">
						<option value="<?php echo $data[nama_penyakit]?>"><?php echo $data[nama_penyakit]?></option>
						<?php
							$sakit=mysqli_query($koneksi, "SELECT * FROM tpenyakit ORDER BY id_penyakit ASC");
							while ($paten=mysqli_fetch_array($sakit)) {
						?>
						<option value="<?php echo $paten[nama_penyakit]?>"><?php echo $paten[nama_penyakit]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">NAMA KABUPATEN</label>
					<select class="form-control" name="nama_kabupaten">
						<option value="<?php echo $data[nama_kabupaten]?>"><?php echo $data[nama_kabupaten]?></option>
						<?php
							$kabu=mysqli_query($koneksi, "SELECT * FROM tkabupaten ORDER BY id_kabupaten ASC");
							while ($paten=mysqli_fetch_array($kabu)) {
						?>
						<option value="<?php echo $paten[nama_kabupaten]?>"><?php echo $paten[nama_kabupaten]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">PENGENDALIAN</label>
					<textarea class="form-control" name="pengendalian" rows="5" cols="40" placeholder="pengendalian"><?php echo $data[pengendalian]?></textarea>
				</div>
				<button type="button" onclick="self.history.back()" class="btn btn-success">Cancel</button>
				<button type="submit" name="update" class="btn btn-success">Update</button>
			</form>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered">
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
							$query=mysqli_query($koneksi, "SELECT * FROM tpengendalian ORDER BY id_pengendalian");
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
break;
}
?>
