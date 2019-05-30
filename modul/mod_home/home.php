<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
			<div class="judul" style="margin-bottom: 10px">
				<span>Data Rekapitulasi Kegiatan</span>
			</div>
            <?php $query = $koneksi->query("SELECT * FROM data_bidang");
            while ($data = $query->fetch_object()) { ?>
            <div class="col-lg-3">
                <div class="row">
                    <div class="thumbnail" style="height: 380px">
                        <img src="./assets/data/logo.jpeg" alt="...">
                        <div class="caption">
                            <h3><?php echo $data->nama_pendek_bidang ?></h3>
                            <p><?php echo $data->nama_panjang_bidang ?></p>
                            <p><a href="#" class="btn btn-primary btn-block">View Details</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
