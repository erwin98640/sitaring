<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="judul">
				<span>LAPORAN PEMETAAN PER - TRIWULAN</span>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
			<form class="" action="" method="post">
				<div class="form-group">
					<label for="">TRIWULAN</label>
					<select class="form-control" name="triwulan">
						<?php
							$query=mysqli_query($koneksi, "SELECT * FROM tpemetaan GROUP BY nama_triwulan ORDER BY id_pemetaan ASC");
							while ($data=mysqli_fetch_array($query)) {
						?>
						<option value="<?php echo $data[nama_triwulan] ?>"><?php echo $data[nama_triwulan] ?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">TAHUN</label>
					<select class="form-control" name="tahun">
						<?php
							$query=mysqli_query($koneksi, "SELECT * FROM tpemetaan GROUP BY tahun ORDER BY id_pemetaan ASC");
							while ($data=mysqli_fetch_array($query)) {
						?>
						<option value="<?php echo $data[tahun] ?>"><?php echo $data[tahun] ?></option>
						<?php
							}
						?>
					</select>
				</div>
				<button type="submit" name="submit" class="btn btn-success">Pilih</button>
			<?php
				$a=$_POST['triwulan'];
				if($a==""){
					echo("Belum ada data yang di pilih");
				}else{
					// echo $_POST['triwulan'];
					echo "<b>Tekan tombol <em>Download Laporan</em> di bawah</b>";
				}
			?>
			</form>
			<?php
				if($a==""){
				?>
					<form>
						<button type="submit" name="submit" class="btn btn-success disabled" data-toggle="tooltip" data-placement="right" title="Belum ada data yang di pilih">Download Laporan</button>
					</form>	
				<?php
				}else{
			?>
			<form action="modul/mod_laporan_triwulan/report_triwulan.php" method="POST">
				<input type="hidden" name="id" value="<?php echo $_POST['triwulan'] ?>">
				<input type="hidden" name="ida" value="<?php echo $_POST['tahun'] ?>">
				<button type="submit" name="submit" class="btn btn-success">Download Laporan</button>
			</form>
			<?php } ?>
		</div>
	</div>
</div>
