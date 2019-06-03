<?php
	if (isset($_POST['submit'])) {
		$jenis_pengadaan=$_POST['jenis_pengadaan'];
		if ($jenis_pengadaan=="") { ?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php } else {
			mysqli_query($koneksi, "INSERT INTO data_jenis_pengadaan (jenis_pengadaan) VALUES('$jenis_pengadaan')") ?>
				<script language="javascript">document.location.href="?module=jenis_pengadaan"</script>
			<?php }
	}

	if (isset($_POST['update'])) {
		$jenis_pengadaan=$_POST['jenis_pengadaan'];
		if ($jenis_pengadaan == "") { ?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php } else {
			$query = mysqli_query($koneksi, "UPDATE data_jenis_pengadaan SET jenis_pengadaan='$jenis_pengadaan' WHERE id_jenis_pengadaan='$_POST[id]'");
		}
	}

	if (isset($_GET['mode'])=='delete') {
		$id_jenis_pengadaan=$_GET['id_jenis_pengadaan'];
		mysqli_query($koneksi, "DELETE FROM data_jenis_pengadaan WHERE id_jenis_pengadaan='$id_jenis_pengadaan'");
	}

switch (isset($_GET["act"])) {	
default: ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>JENIS PENGADAAN</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-9 col-xs-12 col-md-6 col-sm-6">
				<form class="form-inline" action="?module=jenis_pengadaan" method="POST">
					<div class="form-group">
						<label>NAMA PENGADAAN</label>
						<input type="text" name="jenis_pengadaan" placeholder="Input Nama Pengadaan" class="form-control">
					</div>
					<button type="submit" name="submit" class="btn btn-success">Simpan</button>
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
								<th>Nama Pengadaan</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $query=mysqli_query($koneksi, "SELECT * FROM data_jenis_pengadaan ORDER BY jenis_pengadaan ASC");
								$no=1;
								while ($data=mysqli_fetch_object($query)) { ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $data->jenis_pengadaan ?></td>
								<td>
									<a href="?module=jenis_pengadaan&act=update&id_jenis_pengadaan=<?php echo $data->id_jenis_pengadaan ?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=jenis_pengadaan&mode=delete&id_jenis_pengadaan=<?php echo $data->id_jenis_pengadaan ?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
$edit=mysqli_query($koneksi, "SELECT * FROM data_jenis_pengadaan WHERE id_jenis_pengadaan='$_GET[id_jenis_pengadaan]'");
$data=mysqli_fetch_object($edit) ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>JENIS PENGADAAN</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-10 col-xs-12 col-md-6 col-sm-6">
				<form class="form-inline" action="?module=jenis_pengadaan" method="POST">
					<input type="hidden" name="id" value="<?php echo $data->id_jenis_pengadaan ?>" placeholder="">
					<div class="form-group">
						<label>NAMA PENGADAAN</label>
						<input type="text" name="jenis_pengadaan" value="<?php echo $data->jenis_pengadaan ?>" class="form-control">
					</div>
					<button type="button" onclick="self.history.back()" class="btn btn-warning">Cancel</button>
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
								<th>Nama Pengadaan</th>
							</tr>
						</thead>
						<tbody>
							<?php $query=mysqli_query($koneksi, "SELECT * FROM data_jenis_pengadaan ORDER BY jenis_pengadaan ASC");
								$no=1;
								while ($data=mysqli_fetch_object($query)) { ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $data->jenis_pengadaan ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php break; } ?>
