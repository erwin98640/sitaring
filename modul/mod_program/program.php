<?php
	if (isset($_POST['submit'])) {
		$nama_program = $_POST['nama_program'];

		if ($nama_program == "") { ?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php } else {
			mysqli_query($koneksi, "INSERT INTO data_program (nama_program) VALUES ('$nama_program')");
		}
	}

	if (isset($_POST['update'])) {
		$nama_program = $_POST['nama_program'];
		mysqli_query($koneksi, "UPDATE data_program SET nama_program='$nama_program'WHERE id_program='$_POST[id]'");
	}

	if (isset($_GET['mode'])=='delete') {
		mysqli_query($koneksi, "DELETE FROM data_program WHERE id_program='$_GET[id_program]'");
	}
switch (isset($_GET['act'])) {
default: ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA PROGRAM</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-8 col-xs-12 col-md-6 col-sm-6">
				<form action="?module=program" method="POST" class="form-inline">
					<div class="form-group">
						<label class="">NAMA PROGRAM</label>
						<input type="text" name="nama_program" class="form-control" placeholder="Input Nama Program">
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
								<th>Nama Program</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $query=mysqli_query($koneksi, "SELECT * FROM data_program ORDER BY nama_program ASC");
								$no=1;
								while ($data=mysqli_fetch_object($query)) { ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $data->nama_program ?></td>
								<td>
									<a href="?module=program&act=update&id_program=<?php echo $data->id_program ?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=program&mode=delete&id_program=<?php echo $data->id_program ?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
$query=mysqli_query($koneksi, "SELECT * FROM data_program WHERE id_program='$_GET[id_program]'");
$data=mysqli_fetch_object($query) ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="judul">
				<span>DATA PROGRAM</span>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-8 col-xs-12 col-md-6 col-sm-6">
			<form class="form-inline" action="?module=program" method="POST">
				<input type="hidden" name="id" value="<?php echo $data->id_program ?>">
				<div class="form-group">
					<label>NAMA PROGRAM</label>
					<input type="text" name="nama_program" class="form-control" value="<?php echo $data->nama_program ?>">
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
							<th>Nama Program</th>
						</tr>
					</thead>
					<tbody>
						<?php $query=mysqli_query($koneksi, "SELECT * FROM data_program ORDER BY id_program");
							$no=1;
							while ($data=mysqli_fetch_object($query)) { ?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $data->nama_program ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php break; } ?>