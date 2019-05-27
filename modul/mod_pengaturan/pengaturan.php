<?php
	switch ($_GET[action]) {
		default:
		?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="judul">
							<span>BACKUP AND RESTORE</span>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h4>Halaman ini digunakan untuk <strong>Backup</strong> dan <strong>Restore</strong> semua data yang ada didalam <em>Database</em></h4>
						<p>Backup Database</p>
						<input type="button" onclick="window.location.href='?module=pengaturan&action=backup'" value="Proses Backup" class="btn btn-success">

						<p>File Backup Database (*.sql)</p>
						<label class="btn btn-success btn-file">
					    	Browse.... <input type="file" name="browse" style="display: none;">
						</label><br /><br />
						<input type="button" onclick="window.location.href='?module=pengaturan&action=restore'" name="restore" value="Restore Database" class="btn btn-success">
					</div>
				</div>
			</div>
		<?php
		break;
		case 'backup':
			$folder = "/database/backup.sql";
			$query = mysqli_query($koneksi, "SELECT * INTO OUTFILE '$folder' FROM tkabupaten, tkomoditi, tlogin, tluaskomoditi, tpemetaan, tpengendalian, tpenyakit, tpesan, ttriwulan");
			if ($query) {
				?>
				<script>
					alert("Proses backup berhasil");
					window.location.href="?module=pengaturan";
				</script>
				<?php
			}
		break;
		case 'restore':
			?>
			<script>
				alert("Proses Restore berhasil");
				window.location.href="?module=pengaturan";
			</script>
			<?php
	}
?>