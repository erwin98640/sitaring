<?php
	if (isset($_POST['submit'])) {
		$satuan	= $_POST['satuan'];

		if ($satuan == "") { ?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php } else {
			mysqli_query($koneksi, "INSERT INTO data_satuan (satuan) VALUES ('$satuan')");
		}
	}

	if (isset($_POST['update'])) {
		$satuan	= $_POST['satuan'];
		mysqli_query($koneksi, "UPDATE data_satuan SET satuan='$satuan'WHERE id_satuan='$_POST[id]'");
	}

	if (isset($_GET['mode'])=='delete') {
		mysqli_query($koneksi, "DELETE FROM data_satuan WHERE id_satuan='$_GET[id_satuan]'");
	}
switch (isset($_GET['act'])) {
default: ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA SATUAN</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form action="?module=satuan" method="POST" class="form-inline">
					<div class="form-group">
						<label class="">SATUAN</label>
						<input type="text" name="satuan" class="form-control" placeholder="Nama Satuan">
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
								<th>Nama Satuan</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $query=mysqli_query($koneksi, "SELECT * FROM data_satuan ORDER BY satuan ASC");
								$no=1;
								while ($data=mysqli_fetch_object($query)) { ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $data->satuan ?></td>
								<td>
									<a href="?module=satuan&act=update&id_satuan=<?php echo $data->id_satuan ?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=satuan&mode=delete&id_satuan=<?php echo $data->id_satuan ?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
$query=mysqli_query($koneksi, "SELECT * FROM data_satuan WHERE id_satuan='$_GET[id_satuan]'");
$data=mysqli_fetch_object($query) ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="judul">
				<span>DATA SATUAN</span>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-8 col-xs-12 col-md-6 col-sm-6">
			<form class="form-inline" action="?module=satuan" method="POST">
				<input type="hidden" name="id" value="<?php echo $data->id_satuan ?>">
				<div class="form-group">
					<label for="">SATUAN</label>
					<input type="text" name="satuan" class="form-control" value="<?php echo $data->satuan ?>">
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
							<th>Nama Satuan</th>
						</tr>
					</thead>
					<tbody>
						<?php $query=mysqli_query($koneksi, "SELECT * FROM data_satuan ORDER BY id_satuan");
							$no=1;
							while ($data=mysqli_fetch_object($query)) { ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $data->satuan ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php break; } ?>
