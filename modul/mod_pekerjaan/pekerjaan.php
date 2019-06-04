<?php switch (isset($_GET['act'])){ default: ?>

<script type="text/javascript" src="js/jquery-1.12.3.js"></script>
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
<!-- <div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-hover table-striped table-bordered">
					<thead class="text-nowrap text-uppercase">
						<tr class="success">
							<th class="text-center" style="vertical-align: middle;" rowspan="3">No</th>
							<th class="text-center" style="vertical-align: middle;" rowspan="3">Kode / Program dan Kegiatan</th>
							<th class="text-center" style="vertical-align: middle;" colspan="2">Urian</th>
							<th class="text-center" style="vertical-align: middle;" rowspan="3">Pagu Anggaran</th>
							<th class="text-center" style="vertical-align: middle;" rowspan="3">Nomor dan Nilai Kontrak</th>
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
							<th class="text-center">2</th>
							<th class="text-center">3</th>
							<th class="text-center">4</th>
							<th class="text-center">5</th>
							<th class="text-center">6</th>
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
						<?php $query=mysqli_query($koneksi, "SELECT * FROM data_pekerjaan ORDER BY id_pekerjaan");
							$no=1;
							while ($data=mysqli_fetch_assoc($query)) { ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $data["id_pemetaan"] ?></td>
							<td><?php echo $data["nama_triwulan"] ?></td>
							<td><?php echo $data["nama_komoditi"] ?></td>
							<td><?php echo $data["nama_penyakit"] ?></td>
							<td><?php echo $data["nama_kabupaten"] ?></td>
							<td><?php echo $data["luas_komoditas"] ?></td>
							<td><?php echo $data["luas_serangan_ringan"] ?></td>
							<td><?php echo $data["luas_serangan_berat"] ?></td>
							<td><?php echo $data["jumlah"] ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> -->
<?php } ?>