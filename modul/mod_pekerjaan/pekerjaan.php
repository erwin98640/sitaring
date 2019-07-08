<script type="text/javascript" src="assets/js/jquery-1.12.3.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFpkPVjM26Py4C4pDe9RiCVWPl4s_pXrw&callback=initMap"></script>
<script type="text/javascript">
	var peta;
	var jenis = "kelapa";

	var koorx = new Array();
	var koory = new Array();
	var getKode = new Array();
	var getProgram = new Array();
	var getKegiatan = new Array();
	var getNamaPekerjaan = new Array();
	var getTahunPerolehan = new Array();
	var getRealisasiKeuangan = new Array();
	var getRealisasiFisik = new Array();

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
	}

	$(document).ready(function(){
		$("#tutup").click(function(){
			$("#jendelainfo").fadeOut();
		});
	});

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

	function ambildatabase(awal){
		url = "modul/mod_pemetaan/ambildata.php";
		$.ajax({
			url: url,
			dataType: 'json',
			cache: false,
			success: function(msg){
				for(i=0;i<msg.wilayah.petak.length;i++){
				
					koorx[i] = msg.wilayah.petak[i].x;
					koory[i] = msg.wilayah.petak[i].y;
					getKode[i] = msg.wilayah.petak[i].kode;
					getProgram[i] = msg.wilayah.petak[i].program;
					getKegiatan[i] = msg.wilayah.petak[i].kegiatan;
					getNamaPekerjaan[i] = msg.wilayah.petak[i].nama_pekerjaan;
					getTahunPerolehan[i] = msg.wilayah.petak[i].tahun_perolehan;
					getRealisasiKeuangan[i] = msg.wilayah.petak[i].realisasi_keuangan;
					getRealisasiFisik[i] = msg.wilayah.petak[i].realisasi_fisik;
					
					set_icon(msg.wilayah.petak[i].jenis);
					var point = new google.maps.LatLng(
						parseFloat(msg.wilayah.petak[i].x),
						parseFloat(msg.wilayah.petak[i].y));
					tanda = new google.maps.Marker({
						position: point,
						map: peta,
						icon: gambar_tanda
					});
					setinfo(tanda,i);
				}
			}
		});
	}

	function setinfo(petak, nomor){
		google.maps.event.addListener(petak, 'click', function() {
			$("#jendelainfo").fadeIn();
			$("#textKode").html(getKode[nomor]);
			$("#textProgram").html(getProgram[nomor]);
			$("#textKegiatan").html(getKegiatan[nomor]);
			$("#textNamaPekerjaan").html(getNamaPekerjaan[nomor]);
			$("#textTahunPerolehan").html(getTahunPerolehan[nomor]);
			$("#textRealisasiKeuangan").html("Rp "+getRealisasiKeuangan[nomor]);
			$("#textRealisasiFisik").html(getRealisasiFisik[nomor]+" %");
			
			$("#tekskoorx").html(koorx[nomor]);
			$("#tekskoory").html(koory[nomor]);
		});
	}
</script>
<style>
	#jendelainfo {
		position: absolute;
		z-index: 1;
		top: 150;
		left: 0;
		right: 0;
		margin: auto;
		display: none;
	}
</style>
<body onload="peta_awal()">
	<form action="?module=pemetaan" enctype="multipart/form-data" method="POST">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA PEMETAAN</span>
				</div>
			</div>
		</div>
	</div>
	</form>
	<div id="jendelainfo" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button id="tutup" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Informasi Pekerjaan</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-4">
							<strong>KODE / PROGRAM DAN KEGIATAN</strong> <br>
							<span id="textKode"></span><br>
							<span id="textProgram"></span><br>
							<span id="textKegiatan"></span><br>
						</div>	
						<div class="col-lg-4">
							<strong>NAMA PEKERJAAN / TAHUN</strong> <br>
							<span id="textNamaPekerjaan"></span><br>
							<span id="textTahunPerolehan"></span><br>
						</div>
						<div class="col-lg-4">
							<strong>REALISASI KEUANGAN / FISIK</strong> <br>
							<span id="textRealisasiKeuangan"></span><br>
							<span id="textRealisasiFisik"></span><br>
						</div>	
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<a href="./assets/images/kegiatan/<?= $data->image_1 ?>" target="_blank" class="thumbnail">
								<?php if (empty($data->image_1)) { ?>
									<img src="./assets/images/kegiatan/no-image.jpg" alt="Tidak Ada Gambar">
									<?php } else { ?>
									<img src="./assets/images/kegiatan/small_<?= $data->image_1 ?>" alt="<?= $data->nama_pekerjaan ?>">
								<?php } ?>
							</a>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<a href="./assets/images/kegiatan/<?= $data->image_2 ?>" target="_blank" class="thumbnail">
								<?php if (empty($data->image_2)) { ?>
									<img src="./assets/images/kegiatan/no-image.jpg" alt="Tidak Ada Gambar">
									<?php } else { ?>
									<img src="./assets/images/kegiatan/small_<?= $data->image_2 ?>" alt="<?= $data->nama_pekerjaan ?>">
								<?php } ?>
							</a>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<a href="./assets/images/kegiatan/<?= $data->image_3 ?>" target="_blank" class="thumbnail">
								<?php if (empty($data->image_3)) { ?>
									<img src="./assets/images/kegiatan/no-image.jpg" alt="Tidak Ada Gambar">
									<?php } else { ?>
									<img src="./assets/images/kegiatan/small_<?= $data->image_3 ?>" alt="<?= $data->nama_pekerjaan ?>">
								<?php } ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel" id="services">
					<div id="kanvaspeta" style="margin:0px auto; width:100%; height:95%; float:right; padding:0px;"></div>
				</div>
			</div>
		</div>
	</div>
</body>