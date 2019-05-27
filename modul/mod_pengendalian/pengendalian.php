<?php
	if (isset($_POST['submit'])) {
		$nama_triwulan	= $_POST['nama_triwulan'];
		$nama_komoditi	= $_POST['nama_komoditi'];
		$nama_penyakit	= $_POST['nama_penyakit'];
		$nama_kabupaten	= $_POST['nama_kabupaten'];
		$pengendalian 	= $_POST['pengendalian'];

		if ($pengendalian=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$cek = mysqli_query($koneksi, "SELECT count(id_pengendalian) FROM tpengendalian");
			$dcek= mysqli_fetch_array($cek);
			if ($dcek[0]=="0") {
				mysqli_query($koneksi, "INSERT INTO tpengendalian VALUES ('A-001','$nama_triwulan','$nama_komoditi','$nama_penyakit','$nama_kabupaten','$pengendalian')");
				?>
					<script language="javascript">document.location.href="?module=pengendalian"</script>
				<?php
			}else{
				$in = mysqli_query($koneksi, "SELECT id_pengendalian FROM tpengendalian ORDER BY id_pengendalian DESC");
				$ins= mysqli_fetch_array($in);
				$id_peng = substr($ins["id_pengendalian"], -2)+1;
				if ($id_peng>99) {
					$id_pengendalian = "".$id_peng;
				}elseif ($id_peng>9){
					$id_pengendalian = "0".$id_peng;
				}else{
					$id_pengendalian = "00".$id_peng;
				}
				mysqli_query($koneksi, "INSERT INTO tpengendalian VALUES ('A-$id_pengendalian','$nama_triwulan','$nama_komoditi','$nama_penyakit','$nama_kabupaten','$pengendalian')");
			}
		}
	}

	if (isset($_POST['update'])) {
		mysqli_query($koneksi, "UPDATE tpengendalian SET nama_triwulan='$_POST[nama_triwulan]',nama_komoditi='$_POST[nama_komoditi]',nama_penyakit='$_POST[nama_penyakit]',nama_kabupaten='$_POST[nama_kabupaten]',pengendalian='$_POST[pengendalian]' WHERE id_pengendalian='$_POST[id]'");
	}

	if (isset($_GET['mode'])=='delete') {
		mysqli_query($koneksi, "DELETE FROM tpengendalian WHERE id_pengendalian='$_GET[id_pengendalian]'");
	}
switch ($_GET[act]) {
default:
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA PENGENDALIAN</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=pengendalian" method="post">
					<div class="form-group">
						<label for="">TRIWULAN</label>
						<select class="form-control" name="nama_triwulan">
							<?php
								$triwulan=mysqli_query($koneksi, "SELECT * FROM ttriwulan ORDER BY id_triwulan ASC");
								while ($diti=mysqli_fetch_array($triwulan)) {
							?>
							<option value="<?php echo $diti[nama_triwulan]?>"><?php echo $diti[nama_triwulan]?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">NAMA KOMODITI</label>
						<select class="form-control" name="nama_komoditi">
							<?php
								$komoditi=mysqli_query($koneksi, "SELECT * FROM tkomoditi ORDER BY id_komoditi ASC");
								while ($paten=mysqli_fetch_array($komoditi)) {
							?>
							<option value="<?php echo $paten[nama_komoditi]?>"><?php echo $paten[nama_komoditi]?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">NAMA PENYAKIT</label>
						<select class="form-control" name="nama_penyakit">
							<?php
								$sakit=mysqli_query($koneksi, "SELECT * FROM tpenyakit ORDER BY id_penyakit ASC");
								while ($paten=mysqli_fetch_array($sakit)) {
							?>
							<option value="<?php echo $paten[nama_penyakit]?>"><?php echo $paten[nama_penyakit]?></option>
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
						<label for="">PENGENDALIAN</label>
						<textarea class="form-control" name="pengendalian" rows="5" cols="40" placeholder="pengendalian"></textarea>
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
								<th>Triwulan</th>
								<th>Komoditi</th>
								<th>Penyakit</th>
								<th>Kabupaten</th>
								<th>Pengendalian</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM tpengendalian ORDER BY id_pengendalian");
								$no=1;
								while ($data=mysqli_fetch_assoc($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<?php foreach ($data as $key){ ?>
								<td><?php echo $key ?></td>
								<?php } ?>
								<td>
									<a href="?module=pengendalian&act=update&id_pengendalian=<?php echo $data[id_pengendalian] ?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=pengendalian&mode=delete&id_pengendalian=<?php echo $data[id_pengendalian] ?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
$query=mysqli_query($koneksi, "SELECT * FROM tpengendalian WHERE id_pengendalian='$_GET[id_pengendalian]'");
$data=mysqli_fetch_array($query);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="judul">
				<span>DATA PENGENDALIAN</span>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
			<form class="" action="?module=pengendalian" method="post">
				<input type="hidden" name="id" value="<?php echo $data[id_pengendalian]?>">
				<div class="form-group">
					<label for="">TRIWULAN</label>
					<select class="form-control" name="nama_triwulan">
						<option value="<?php echo $data[nama_triwulan]?>"><?php echo $data[nama_triwulan]?></option>
						<?php
							$triwulan=mysqli_query($koneksi, "SELECT * FROM ttriwulan ORDER BY id_triwulan ASC");
							while ($diti=mysqli_fetch_array($triwulan)) {
						?>
						<option value="<?php echo $diti[nama_triwulan]?>"><?php echo $diti[nama_triwulan]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">NAMA KOMODITI</label>
					<select class="form-control" name="nama_komoditi">
						<option value="<?php echo $data[nama_komoditi]?>"><?php echo $data[nama_komoditi]?></option>
						<?php
							$komoditi=mysqli_query($koneksi, "SELECT * FROM tkomoditi ORDER BY id_komoditi ASC");
							while ($paten=mysqli_fetch_array($komoditi)) {
						?>
						<option value="<?php echo $paten[nama_komoditi]?>"><?php echo $paten[nama_komoditi]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">NAMA PENYAKIT</label>
					<select class="form-control" name="nama_penyakit">
						<option value="<?php echo $data[nama_penyakit]?>"><?php echo $data[nama_penyakit]?></option>
						<?php
							$sakit=mysqli_query($koneksi, "SELECT * FROM tpenyakit ORDER BY id_penyakit ASC");
							while ($paten=mysqli_fetch_array($sakit)) {
						?>
						<option value="<?php echo $paten[nama_penyakit]?>"><?php echo $paten[nama_penyakit]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">NAMA KABUPATEN</label>
					<select class="form-control" name="nama_kabupaten">
						<option value="<?php echo $data[nama_kabupaten]?>"><?php echo $data[nama_kabupaten]?></option>
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
					<label for="">PENGENDALIAN</label>
					<textarea class="form-control" name="pengendalian" rows="5" cols="40" placeholder="pengendalian"><?php echo $data[pengendalian]?></textarea>
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
							<th>Id</th>
							<th>Triwulan</th>
							<th>Komoditi</th>
							<th>Penyakit</th>
							<th>Kabupaten</th>
							<th>Pengendalian</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query=mysqli_query($koneksi, "SELECT * FROM tpengendalian ORDER BY id_pengendalian");
							$no=1;
							while ($data=mysqli_fetch_assoc($query)) {
						?>
						<tr>
							<td><?php echo $no ?></td>
							<?php foreach ($data as $key){ ?>
							<td><?php echo $key ?></td>
							<?php } ?>
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
