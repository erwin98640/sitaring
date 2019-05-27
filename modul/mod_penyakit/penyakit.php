<?php
	if (isset($_POST['submit'])) {
		$nama_penyakit=$_POST['nama_penyakit'];
		$nama_komoditi=$_POST['nama_komoditi'];
		$keterangan_penyakit=$_POST['keterangan_penyakit'];
		if ($nama_penyakit=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$cek = mysqli_query($koneksi, "SELECT count(id_penyakit) FROM tpenyakit");
			$dcek= mysqli_fetch_array($cek);
			if ($dcek[0]=="0") {
				mysqli_query($koneksi, "INSERT INTO tpenyakit VALUES('P-001','$nama_penyakit','$nama_komoditi','$keterangan_penyakit')");
				?>
					<script language="javascript">document.location.href="?module=penyakit"</script>
				<?php
			}else{
				$in = mysqli_query($koneksi, "SELECT id_penyakit FROM tpenyakit ORDER BY id_penyakit DESC");
				$ins= mysqli_fetch_array($in);
				$id_sakit = substr($ins["id_penyakit"], -2)+1;
				if ($id_sakit>99) {
					$id_penyakit = "".$id_sakit;
				}elseif ($id_sakit>9){
					$id_penyakit = "0".$id_sakit;
				}else{
					$id_penyakit = "00".$id_sakit;
				}
				mysqli_query($koneksi, "INSERT INTO tpenyakit VALUES('P-$id_penyakit','$nama_penyakit','$nama_komoditi','$keterangan_penyakit')");
				?>
					<script language="javascript">document.location.href="?module=penyakit"</script>
				<?php
			}
		}
	}

	if (isset($_POST['update'])) {
		if ($_POST[nama_penyakit]=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			mysqli_query($koneksi, "UPDATE tpenyakit SET nama_penyakit='$_POST[nama_penyakit]',nama_komoditi='$_POST[nama_komoditi]',keterangan_penyakit='$_POST[keterangan_penyakit]' WHERE id_penyakit='$_POST[id]'");
		}
	}

	if (isset($_GET['mode'])=='delete') {
		mysqli_query($koneksi, "DELETE FROM tpenyakit WHERE id_penyakit='$_GET[id_penyakit]'");
	}

switch ($_GET[act]) {
default:
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA PENYAKIT</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=penyakit" method="post">
					<div class="form-group">
						<label for="">NAMA PENYAKIT</label>
						<input type="text" name="nama_penyakit" value="" placeholder="nama penyakit" class="form-control">
					</div>
					<div class="form-group">
						<label for="">NAMA KOMODITI</label>
						<select class="form-control" name="nama_komoditi">
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM tkomoditi ORDER BY id_komoditi ASC");
								while ($data=mysqli_fetch_array($query)) {
							?>
							<option value="<?php echo $data[nama_komoditi] ?>"><?php echo $data[nama_komoditi] ?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="comment">KETERANGAN</label>
						<textarea class="form-control" name="keterangan_penyakit" rows="5" id="comment" placeholder="tulis keterangan"></textarea>
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
								<th>Id</th>
								<th>Nama Penyakit</th>
								<th>Nama Komoditi</th>
								<th>Keterangan</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM tpenyakit ORDER BY id_penyakit ASC");
								$no=1;
								while ($data=mysqli_fetch_array($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_penyakit] ?></td>
								<td><?php echo $data[nama_penyakit] ?></td>
								<td><?php echo $data[nama_komoditi] ?></td>
								<td><?php echo $data[keterangan_penyakit] ?></td>
								<td>
									<a href="?module=penyakit&act=update&id_penyakit=<?php echo $data[id_penyakit] ?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=penyakit&mode=delete&id_penyakit=<?php echo $data[id_penyakit] ?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
$edit=mysqli_query($koneksi, "SELECT * FROM tpenyakit WHERE id_penyakit='$_GET[id_penyakit]'");
$datar=mysqli_fetch_array($edit);
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA PENYAKIT</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=penyakit" method="post">
					<input type="hidden" name="id" value="<?php echo $datar[id_penyakit] ?>" placeholder="">
					<div class="form-group">
						<label for="">NAMA PENYAKIT</label>
						<input type="text" name="nama_penyakit" value="<?php echo $datar[nama_penyakit] ?>" placeholder="nama penyakit" class="form-control">
					</div>
					<div class="form-group">
						<label for="">NAMA KOMODITI</label>
						<select class="form-control" name="nama_komoditi">
							<option value="<?php echo $datar[nama_komoditi] ?>"><?php echo $datar[nama_komoditi] ?></option>}
							option
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM tkomoditi ORDER BY id_komoditi ASC");
								while ($data=mysqli_fetch_array($query)) {
							?>
							<option value="<?php echo $data[nama_komoditi] ?>"><?php echo $data[nama_komoditi] ?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="comment">KETERANGAN</label>
						<textarea class="form-control" name="keterangan_penyakit" rows="5" id="comment" placeholder="tulis keterangan"><?php echo $datar[keterangan_penyakit] ?></textarea>
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
								<th>Id Penyakit</th>
								<th>Nama Penyakit</th>
								<th>Nama Komoditi</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM tpenyakit ORDER BY id_penyakit ASC");
								$no=1;
								while ($data=mysqli_fetch_array($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_penyakit] ?></td>
								<td><?php echo $data[nama_penyakit] ?></td>
								<td><?php echo $data[nama_komoditi] ?></td>
								<td><?php echo $data[keterangan_penyakit] ?></td>
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
