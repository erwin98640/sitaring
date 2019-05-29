<?php
	if(isset($_POST['submit'])) {
		$nama_panjang_bidang= $_POST['nama_panjang_bidang'];
		$nama_pendek_bidang	= $_POST['nama_pendek_bidang'];

		if ($nama_pendek_bidang == "" OR $nama_panjang_bidang == "") { ?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php } else {
			mysqli_query($koneksi, "INSERT INTO data_bidang (nama_panjang_bidang, nama_pendek_bidang) VALUES('$nama_panjang_bidang','$nama_pendek_bidang')"); ?>
			<script language="javascript">document.location.href="?module=bidang"</script>
			<?php }
	}

	if (isset($_POST['update'])) {
		$id_bidang			= $_POST['id'];
		$nama_panjang_bidang= $_POST['nama_panjang_bidang'];
		$nama_pendek_bidang	= $_POST['nama_pendek_bidang'];

		if ($nama_pendek_bidang == "" OR $nama_panjang_bidang == "") { ?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php } else {
			$query=mysqli_query($koneksi, "UPDATE data_bidang SET nama_panjang_bidang='$nama_panjang_bidang', nama_pendek_bidang='$nama_pendek_bidang' WHERE id_bidang='$id_bidang'");
		}
	}

	if(isset($_GET['mode']) =='delete') {
		 $id_bidang = $_GET['id_bidang'];
		 mysqli_query($koneksi, "DELETE FROM data_bidang WHERE id_bidang='$id_bidang'");
	}

switch(isset($_GET['act'])) {
	default: ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA BIDANG</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<form action="?module=bidang" method="POST">
				<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
					<div class="form-group">
						<label>NAMA PANJANG BIDANG</label>
						<input type="text" name="nama_panjang_bidang" value="" placeholder="nama panjang bidang" class="form-control">
					</div>
				</div>
				<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
					<div class="form-group">
						<label>NAMA PENDEK BIDANG</label>
						<input type="text" name="nama_pendek_bidang" value="" placeholder="nama pendek bidang" class="form-control">
					</div>
					<button type="submit" name="submit" class="btn btn-success pull-right">Simpan</button>
				</div>
			</form>
		</div>
	</div>
	<div class="container-fluid" style="margin-top: 10px">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr class="success text-uppercase">
								<th>No</th>
								<th>Nama Panjang Bidang</th>
								<th>Nama Pendek Bidang</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $query=$koneksi->query("SELECT * FROM data_bidang");
								$no=1;
								while ($data=$query->fetch_object()) { ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $data->nama_panjang_bidang ?></td>
								<td><?php echo $data->nama_pendek_bidang ?></td>
								<td>
									<a href="?module=bidang&act=update&id_bidang=<?php echo $data->id_bidang ?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=bidang&mode=delete&id_bidang=<?php echo $data->id_bidang ?>" onClick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
$edit=mysqli_query($koneksi,"SELECT * FROM data_bidang WHERE id_bidang='$_GET[id_bidang]'");
$data=mysqli_fetch_object($edit) ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA BIDANG</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<form action="?module=bidang" method="POST">
				<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
					<input type="hidden" name="id" value="<?php echo $data->id_bidang ?>">
					<div class="form-group">
						<label>NAMA PANJANG BIDANG</label>
						<input type="text" name="nama_panjang_bidang" value="<?php echo $data->nama_panjang_bidang ?>" class="form-control">
					</div>
				</div>
				<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
					<div class="form-group">
						<label>NAMA PENDEK BIDANG</label>
						<input type="text" name="nama_pendek_bidang" value="<?php echo $data->nama_pendek_bidang ?>" class="form-control">
					</div>
					<button type="submit" name="update" class="btn btn-success pull-right" style="margin-left: 10px">Update</button>
					<button type="button" class="btn btn-warning pull-right" onclick="self.history.back()">Cancel</button>
				</div>
			</form>
		</div>
	</div>
	<div class="container-fluid" style="margin-top: 10px">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr class="success text-uppercase">
								<th>No</th>
								<th>NAMA PANJANG BIDANG</th>
								<th>NAMA PENDEK BIDANG</th>
							</tr>
						</thead>
						<tbody>
							<?php $query=mysqli_query($koneksi, "SELECT * FROM data_bidang");
								$no=1;
								while ($data=mysqli_fetch_object($query)) { ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $data->nama_panjang_bidang ?></td>
								<td><?php echo $data->nama_pendek_bidang ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php break; } ?>
