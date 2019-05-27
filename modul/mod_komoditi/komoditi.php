<?php
	if (isset($_POST['submit'])) {
		$nama_komoditi=$_POST['nama_komoditi'];
		if ($nama_komoditi=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$cek = mysqli_query($koneksi, "SELECT count(id_komoditi) FROM tkomoditi");
			$dcek= mysqli_fetch_array($cek);
			if ($dcek[0]=="0") {
				mysqli_query($koneksi, "INSERT INTO tkomoditi VALUES('D-001','$nama_komoditi')");
				?>
					<script language="javascript">document.location.href="?module=komoditi"</script>
				<?php
			}else{
				$in = mysqli_query($koneksi, "SELECT id_komoditi FROM tkomoditi ORDER BY id_komoditi DESC");
				$ins= mysqli_fetch_array($in);
				$id_kom = substr($ins["id_komoditi"], -2)+1;
				if ($id_kom>99) {
					$id_komoditi = "".$id_kom;
				}elseif ($id_kom>9){
					$id_komoditi = "0".$id_kom;
				}else{
					$id_komoditi = "00".$id_kom;
				}
				mysqli_query($koneksi, "INSERT INTO tkomoditi VALUES('D-$id_komoditi','$nama_komoditi')");
				?>
					<script language="javascript">document.location.href="?module=komoditi"</script>
				<?php
			}
		}
	}

	if (isset($_POST['update'])) {
		if ($_POST[nama_komoditi]=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$query = mysqli_query($koneksi, "UPDATE tkomoditi SET nama_komoditi='$_POST[nama_komoditi]' WHERE id_komoditi='$_POST[id]'");
		}
	}

	if (isset($_GET['mode'])=='delete') {
		$id_komoditi=$_GET['id_komoditi'];
		mysqli_query($koneksi, "DELETE FROM tkomoditi WHERE id_komoditi='$id_komoditi'");
	}

switch ($_GET[act]) {	
default:
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA KOMODITI</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=komoditi" method="post">
					<div class="form-group">
						<label for="nama_komoditi">NAMA KOMODITI</label>
						<input type="text" name="nama_komoditi" id="nama_komoditi" value="" placeholder="nama komoditi" class="form-control">
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
								<th>Id Komoditi</th>
								<th>Nama Komoditi</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$query=mysqli_query($koneksi, "SELECT * FROM tkomoditi ORDER BY id_komoditi ASC");
								$no=1;
								while ($data=mysqli_fetch_array($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_komoditi] ?></td>
								<td><?php echo $data[nama_komoditi] ?></td>
								<td>
									<a href="?module=komoditi&act=update&id_komoditi=<?php echo $data[id_komoditi]?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=komoditi&mode=delete&id_komoditi=<?php echo $data[id_komoditi]?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
$edit=mysqli_query($koneksi, "SELECT * FROM tkomoditi WHERE id_komoditi='$_GET[id_komoditi]'");
$data=mysqli_fetch_array($edit);
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA KOMODITI</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=komoditi" method="post">
					<input type="hidden" name="id" value="<?php echo $data[id_komoditi] ?>" placeholder="">
					<div class="form-group">
						<label for="nama_komoditi">NAMA KOMODITI</label>
						<input type="text" name="nama_komoditi" id="nama_komoditi" value="<?php echo $data[nama_komoditi] ?>" placeholder="nama komoditi" class="form-control">
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
								<th>Id Komoditi</th>
								<th>Nama Komoditi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$query=mysqli_query($koneksi, "SELECT * FROM tkomoditi ORDER BY id_komoditi ASC");
								$no=1;
								while ($data=mysqli_fetch_array($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_komoditi] ?></td>
								<td><?php echo $data[nama_komoditi] ?></td>
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
