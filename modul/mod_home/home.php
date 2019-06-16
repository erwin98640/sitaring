<div class="container-fluid">
    <h1 class="text-center bg-info" style="padding: 10px 0 10px 0">SITARING HAJA <br>
        <small>Sistem Informasi Identifikasi Data Monitoring Hasil Pekerjaan</small></h1><br><br>
    <div class="row">
        <div class="col-lg-12">
			<div class="judul" style="margin-bottom: 10px">
				<span>Data Rekapitulasi Kegiatan</span>
			</div>
            <?php $query = $koneksi->query("
                    SELECT
                        data_bidang.nama_panjang_bidang,
                        data_bidang.nama_pendek_bidang,
                        Count(data_pekerjaan.penanggung_jawab) AS Count_penanggung_jawab
                    FROM
                        data_bidang LEFT OUTER JOIN
                        data_pekerjaan ON data_pekerjaan.penanggung_jawab = data_bidang.id_bidang
                    GROUP BY
                        data_bidang.nama_panjang_bidang,
                        data_bidang.nama_pendek_bidang,
                        data_bidang.id_bidang
                    ORDER BY
                        data_bidang.id_bidang");
                while ($data = $query->fetch_object()) { ?>
            <div class="col-lg-3">
                <div class="row">
                    <div class="thumbnail" style="height: 300px">
                        <!-- <img src="./assets/data/logo.jpeg" alt="..."> -->
                        <div class="bg-info" style="padding: 20px 0 20px 0">
                            <h2 class="text-center"><?php echo $data->Count_penanggung_jawab ?><br> <small>Kegiatan</small></h2>
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
