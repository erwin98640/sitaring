<?php
	if (isset($_POST['submit'])) {
		$jenis 				  = $_POST['jenis'];
		$nama_triwulan 		  = $_POST['nama_triwulan'];
		$nama_komoditi		  = $_POST['nama_komoditi'];
		$nama_penyakit		  = $_POST['nama_penyakit'];
		$nama_kabupaten		  = $_POST['nama_kabupaten'];
		$luas_komoditas 	  = $_POST['luas_komoditas'];
		$luas_serangan_ringan = $_POST['luas_serangan_ringan'];
		$luas_serangan_berat  = $_POST['luas_serangan_berat'];
		$jumlah  			  = $_POST['jumlah'];
		$koordinat_x		  = $_POST['koordinat_x'];
		$koordinat_y		  = $_POST['koordinat_y'];
		$tahun 				  = $_POST['tahun'];
		if ($luas_komoditas=="" OR $luas_serangan_ringan=="" OR $luas_serangan_berat=="" OR $jumlah=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$cek = mysqli_query($koneksi, "SELECT count(id_pemetaan) FROM tpemetaan");
			$dcek= mysqli_fetch_array($cek);
			if ($dcek[0]=="0") {
				mysqli_query($koneksi, "INSERT INTO tpemetaan VALUES ('$jenis','R-001','$nama_triwulan','$nama_komoditi','$nama_penyakit','$nama_kabupaten','$luas_komoditas','$luas_serangan_ringan','$luas_serangan_berat','$jumlah','$koordinat_x','$koordinat_y', '$tahun')");
				?>
					<script language="javascript">document.location.href="?module=pemetaan"</script>
				<?php
			}else{
				$in = mysqli_query($koneksi, "SELECT id_pemetaan FROM tpemetaan ORDER BY id_pemetaan DESC");
				$ins= mysqli_fetch_array($in);
				$id_taan = substr($ins["id_pemetaan"], -2)+1;
				if ($id_taan>99) {
					$id_pemetaan = "".$id_taan;
				}elseif ($id_taan>9){
					$id_pemetaan = "0".$id_taan;
				}else{
					$id_pemetaan = "00".$id_taan;
				}
				mysqli_query($koneksi, "INSERT INTO tpemetaan VALUES ('$jenis','R-$id_pemetaan','$nama_triwulan', '$nama_komoditi', '$nama_penyakit','$nama_kabupaten','$luas_komoditas', '$luas_serangan_ringan', '$luas_serangan_berat', '$jumlah', '$koordinat_x', '$koordinat_y', '$tahun')");
				?>
					<script language="javascript">document.location.href="?module=pemetaan"</script>
				<?php
			}
		}
	}

	if(isset($_GET['mode'])=='delete'){
		$id_pemetaan=$_GET['id_pemetaan'];
		mysqli_query($koneksi, "delete from tpemetaan where id_pemetaan='$id_pemetaan'");
		?>
			<script language="javascript">document.location.href="?module=pemetaan"</script>
		<?php
	}
switch ($_GET[act]) {
default:
?>

<script type="text/javascript" src="js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
	            icon: gambar_tanda
	    });
	    $("#x").val(lokasi.lat());
	    $("#y").val(lokasi.lng());

	}

	function set_icon(jenisnya){
	    switch(jenisnya){
	        case "kelapa":
	            gambar_tanda = 'images/kelapa.png';
	            break;
	        case "kelapa_sawit":
	            gambar_tanda = 'images/kelapa_sawit.png';
	            break;
	        case  "karet":
	            gambar_tanda = 'images/karet.png';
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
	<form class="" action="?module=pemetaan" method="post">
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
					<label for="">ICON TUMBUHAN</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="images/kelapa.png">
					<input type="radio" checked name="jenis" value="kelapa" onclick="setjenis(this.value)"> Kelapa&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="images/kelapa_sawit.png">
					<input type="radio" name="jenis" value="kelapa_sawit" onclick="setjenis(this.value)"> Kelapa Sawit&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="images/karet.png">
					<input type="radio" name="jenis" value="karet" onclick="setjenis(this.value)"> Karet&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<div class="form-group">
					<label for="">TRIWULAN</label>
					<select class="form-control" name="nama_triwulan">
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
					<label for="">TAHUN</label>
					<select class="form-control" name="tahun">
						<?php
							$triwulan=mysqli_query($koneksi, "SELECT * FROM ttriwulan GROUP BY tahun ORDER BY id_triwulan ASC");
							while ($diti=mysqli_fetch_array($triwulan)) {
						?>
						<option value="<?php echo $diti[tahun]?>"><?php echo $diti[tahun]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">NAMA KOMODITI</label>
					<select class="form-control" name="nama_komoditi">
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
			</div>
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<div class="form-group">
					<label for="">LUAS KOMODITAS</label>
					<select class="form-control" name="luas_komoditas">
						<?php
							$kabu=mysqli_query($koneksi, "SELECT * FROM tluaskomoditi ORDER BY id_luas_komoditi ASC");
							while ($paten=mysqli_fetch_array($kabu)) {
						?>
						<option value="<?php echo $paten[luas_komoditi]?>"><?php echo $paten[luas_komoditi]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">LUAS SERANGAN RINGAN</label>
					<input type="text" class="form-control" name="luas_serangan_ringan" value="" placeholder="luas serangan ringan">
				</div>
				<div class="form-group">
					<label for="">LUAS SERANGAN BERAT</label>
					<input type="text" class="form-control" name="luas_serangan_berat" value="" placeholder="luas serangan berat">
				</div>
				<div class="form-group">
					<label for="">JUMLAH</label>
					<input type="text" class="form-control" name="jumlah" value="" placeholder="jumlah">
				</div>
				<div class="col-lg-6">
					<div class="form-group" style="clear:padding-left;">
						<label for="">KOORDINAT X</label>
						<input type="text" class="form-control" readonly="readonly" name="koordinat_x" id="x" value="" placeholder="koordinat x">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="">KOORDINAT Y</label>
						<input type="text" class="form-control" readonly="readonly" name="koordinat_y" id="y" value="" placeholder="koordinat y">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<button type="submit" name="submit" class="btn btn-success">Simpan</button>
	</div><br />
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
						<thead>
							<tr class="success text-uppercase">
								<th>No</th>
								<th>Id</th>
								<th>Triwulan</th>
								<th>Komoditi</th>
								<th>Penyakit</th>
								<th>Kabupaten</th>
								<th>luas</th>
								<th>serangan_ringan</th>
								<th>serangan_berat</th>
								<th>jumlah</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM tpemetaan ORDER BY id_pemetaan");
								$no=1;
								while ($data=mysqli_fetch_assoc($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data["id_pemetaan"] ?></td>
								<td><?php echo $data["nama_triwulan"] ?></td>
								<td><?php echo $data["nama_komoditi"] ?></td>
								<td><?php echo $data["nama_penyakit"] ?></td>
								<td><?php echo $data["nama_kabupaten"] ?></td>
								<td><?php echo $data["luas_komoditas"] ?></td>
								<td><?php echo $data["luas_serangan_ringan"] ?></td>
								<td><?php echo $data["luas_serangan_berat"] ?></td>
								<td><?php echo $data["jumlah"] ?></td>
								<td>
									<!--a href="?module=pengendalian&act=update&id_pengendalian=<?php //echo $data[id_pengendalian] ?>"><span class="glyphicon glyphicon-edit"></a></span>-->
									<a href="?module=pemetaan&mode=delete&id_pemetaan=<?php echo $data[id_pemetaan] ?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
								</td>
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
case 'update':
$query=mysqli_query($koneksi, "SELECT * FROM tpengendalian WHERE id_pengendalian='$_GET[id_pengendalian]'");
$data=mysqli_fetch_array($query);
?>
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
