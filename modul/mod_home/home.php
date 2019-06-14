<div class="container-fluid">
    <h1 class="text-center bg-info" style="padding: 10px 0 10px 0">SITARING HAJA <br>
        <small>Sistem Informasi Identifikasi Data Monitoring Hasil Pekerjaan</small></h1><br><br>
    <div class="row">
        <div class="col-lg-12">
			<div class="judul" style="margin-bottom: 10px">
				<span>Data Rekapitulasi Kegiatan</span>
			</div>
            <?php $query = $koneksi->query("SELECT * FROM data_bidang");
            while ($data = $query->fetch_object()) { ?>
            <div class="col-lg-3">
                <div class="row">
                    <div class="thumbnail" style="height: 300px">
                        <!-- <img src="./assets/data/logo.jpeg" alt="..."> -->
                        <div class="bg-info" style="padding: 20px 0 20px 0">
                            <h2 class="text-center">0 <br> <small>Kegiatan</small></h2>
                        </div>
                        <div class="caption">
                            <h3><?php echo $data->nama_pendek_bidang ?></h3>
                            <p><?php echo $data->nama_panjang_bidang ?></p>
                            <!-- <p><a href="#" class="btn btn-primary btn-block">View Details</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
