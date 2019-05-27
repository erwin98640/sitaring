<?php
	if (isset($_POST["update"])) {
		mysqli_query($koneksi, "UPDATE tpesan SET balasan='$_POST[balasan]' WHERE no_pesan='$_POST[no_pesan]'");
	}

	switch ($_GET[action]) {
		default:
		?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="judul">
							<span>Pesan</span>
						</div>
						<div class="table-responsive">
							<table class="table table-hover table-striped table-bordered">
								<caption>table title and/or explanatory text</caption>
								<thead>
									<tr class="success text-uppercase">
										<th>No</th>
										<th>Pengirim</th>
										<th>Judul</th>
										<th>Isi pesan</th>
										<th>aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$query = mysqli_query($koneksi, "SELECT * FROM tpesan ORDER BY no_pesan DESC");
										$no = 1;
										while ($data = mysqli_fetch_array($query)) {
										?>
											<tr>
												<td><?php echo $no ?></td>
												<td>
													<?php
														$querys = mysqli_query($koneksi, "SELECT * FROM tlogin WHERE username='$data[nik]'");
														$datas = mysqli_fetch_array($querys);
														echo $datas[nama_lengkap]
													?>
												</td>
												<td><?php echo $data[judul] ?></td>
												<td><?php echo $data[pesan] ?></td>
												<td>
													<a href="?module=pesan&action=view&no_pesan=<?php echo $data[no_pesan] ?>"><input type="button" name="" value="Lihat" class="btn btn-primary btn-xs">
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
		case 'view':
			$query = mysqli_query($koneksi, "SELECT * FROM tpesan WHERE no_pesan='$_GET[no_pesan]'");
			$data = mysqli_fetch_array($query);
			?>
			<div class="container-fluid">
				<i>Dari :</i><br />
				<?php
					$querys = mysqli_query($koneksi, "SELECT * FROM tlogin WHERE username='$data[nik]'");
					$datas = mysqli_fetch_array($querys);
					echo "<strong><font color='#5CB85C'>".$datas[nama_lengkap]."</font></strong><br /><br />";
					
					echo "<strong>".$data[judul]."</strong><hr />";
				?>
				<div class="row">
					<div class="col-lg-6">
						<div class="thumbnail">
							<?php
								echo "<p>".$data[pesan]."</p>";
							?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-offset-6">
						<?php
							if ($data[balasan]=="") {
							?>
								<form action="?module=pesan" method="POST" accept-charset="utf-8">
									<input type="hidden" name="no_pesan" value="<?php echo $data[no_pesan] ?>">
									<textarea class="form-control" name="balasan" placeholder="tulis pesan balasan"></textarea><br />
									<input type="submit" name="update" value="Balas" class="btn-xs btn btn-primary pull-right">
								</form>
							<?php
							}else{
							?>
								<div class="thumbnail">
									<?php echo "<p class='text-right'>".$data[balasan]."</p>"; ?>
								</div>
							<?php	
							}
						?>
					</div>
				</div>
				<input type="button" onclick="self.history.back()" value="Kembali" class="btn btn-success btn-xs"><br /><br />
			</div>
			<?php
			break;
	}
?>