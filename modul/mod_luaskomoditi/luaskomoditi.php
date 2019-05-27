<?php
	if (isset($_POST['submit'])) {
		$nama_komoditi=$_POST['nama_komoditi'];
		$nama_kabupaten=$_POST['nama_kabupaten'];
		$luas_komoditi=$_POST['luas_komoditi'];
		if ($luas_komoditi=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$cek = mysqli_query($koneksi, "SELECT count(id_luas_komoditi) FROM tluaskomoditi");
			$dcek= mysqli_fetch_array($cek);
			if ($dcek[0]=="0") {
				mysqli_query($koneksi, "INSERT INTO tluaskomoditi VALUES ('L-001','$nama_komoditi','$nama_kabupaten','$luas_komoditi')");
				?>
					<script language="javascript">document.location.href="?module=luaskomoditi"</script>
				<?php
			}else{
				$in = mysqli_query($koneksi, "SELECT id_luas_komoditi FROM tluaskomoditi ORDER BY id_luas_komoditi DESC");
				$ins= mysqli_fetch_array($in);
				$id_luas = substr($ins["id_luas_komoditi"], -2)+1;
				if ($id_luas>99) {
					$id_luas_komoditi = "".$id_luas;
				}elseif ($id_luas>9){
					$id_luas_komoditi = "0".$id_luas;
				}else{
					$id_luas_komoditi = "00".$id_luas;
				}
				mysqli_query($koneksi, "INSERT INTO tluaskomoditi VALUES ('L-$id_luas_komoditi','$nama_komoditi','$nama_kabupaten','$luas_komoditi')");
				?>
					<script language="javascript">document.location.href="?module=luaskomoditi"</script>
				<?php
			}
		}
	}

	if (isset($_POST['update'])) {
		if ($_POST[luas_komoditi]=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$query = mysqli_query($koneksi, "UPDATE tluaskomoditi SET nama_komoditi='$_POST[nama_komoditi]',nama_kabupaten='$_POST[nama_kabupaten]',luas_komoditi='$_POST[luas_komoditi]' WHERE id_luas_komoditi='$_POST[id]'");
		}
	}

	if (isset($_GET['mode'])=='delete') {
		mysqli_query($koneksi, "DELETE FROM tluaskomoditi WHERE id_luas_komoditi='$_GET[id_luas_komoditi]'");
	}
switch ($_GET[act]) {
default:
?>	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA LUAS KOMODITI</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=luaskomoditi" method="post">
					<div class="form-group">
						<label for="">NAMA KOMODITI</label>
						<select class="form-control" name="nama_komoditi">
							<?php
								$komo=mysqli_query($koneksi, "SELECT * FROM tkomoditi ORDER BY id_komoditi ASC");
								while ($diti=mysqli_fetch_array($komo)) {
							?>
							<option value="<?php echo $diti[nama_komoditi]?>"><?php echo $diti[nama_komoditi]?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">NAMA KABUPATEN</label>
						<select class="form-control" name="nama_kabupaten">
							<?php
								$kabu=mysqli_query($koneksi, "SELECT * FROM tkabupaten ORDER BY id_kabupaten ASC");
								while ($paten=mysqli_fetch_array($kabu)) {
							?>
							<option value="<?php echo $paten[nama_kabupaten]?>"><?php echo $paten[nama_kabupaten]?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">LUAS KOMODITI</label>
						<input type="text" name="luas_komoditi" value="" placeholder="luas komoditas" class="form-control">
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
								<th>Id luas komoditi</th>
								<th>Nama Komoditi</th>
								<th>Nama Kabupaten</th>
								<th>Luas Komoditi</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM tluaskomoditi ORDER BY id_luas_komoditi");
								$no=1;
								while ($data=mysqli_fetch_array($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_luas_komoditi] ?></td>
								<td><?php echo $data[nama_komoditi] ?></td>
								<td><?php echo $data[nama_kabupaten] ?></td>
								<td><?php echo $data[luas_komoditi] ?></td>
								<td>
									<a href="?module=luaskomoditi&act=update&id_luas_komoditi=<?php echo $data[id_luas_komoditi] ?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=luaskomoditi&mode=delete&id_luas_komoditi=<?php echo $data[id_luas_komoditi] ?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
case 'update':
$query=mysqli_query($koneksi, "SELECT * FROM tluaskomoditi WHERE id_luas_komoditi='$_GET[id_luas_komoditi]'");
$data=mysqli_fetch_array($query);
?>
<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA LUAS KOMODITI</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=luaskomoditi" method="post">
					<input type="hidden" name="id" value="<?php echo $data[id_luas_komoditi] ?>">
					<div class="form-group">
						<label for="">NAMA KOMODITI</label>
						<select class="form-control" name="nama_komoditi">
							<option value="<?php echo $data[nama_komoditi] ?>"><?php echo $data[nama_komoditi] ?></option>
							<?php
								$komo=mysqli_query($koneksi, "SELECT * FROM tkomoditi ORDER BY id_komoditi ASC");
								while ($diti=mysqli_fetch_array($komo)) {
							?>
							<option value="<?php echo $diti[nama_komoditi]?>"><?php echo $diti[nama_komoditi]?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">NAMA KABUPATEN</label>
						<select class="form-control" name="nama_kabupaten">
							<option value="<?php echo $data[nama_kabupaten] ?>"><?php echo $data[nama_kabupaten] ?></option>
							<?php
								$kabu=mysqli_query($koneksi, "SELECT * FROM tkabupaten ORDER BY id_kabupaten ASC");
								while ($paten=mysqli_fetch_array($kabu)) {
							?>
							<option value="<?php echo $paten[nama_kabupaten]?>"><?php echo $paten[nama_kabupaten]?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">LUAS KOMODITI</label>
						<input type="text" name="luas_komoditi" value="<?php echo $data[luas_komoditi] ?>" placeholder="luas komoditas" class="form-control">
					</div>
					<button type="button" onclick="self.history.back()" class="btn btn-success">Cancel</button>
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
								<th>Id luas komoditi</th>
								<th>Nama Komoditi</th>
								<th>Nama Kabupaten</th>
								<th>Luas Komoditi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM tluaskomoditi ORDER BY id_luas_komoditi");
								$no=1;
								while ($data=mysqli_fetch_array($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_luas_komoditi] ?></td>
								<td><?php echo $data[nama_komoditi] ?></td>
								<td><?php echo $data[nama_kabupaten] ?></td>
								<td><?php echo $data[luas_komoditi] ?></td>
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
}
?>