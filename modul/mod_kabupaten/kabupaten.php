<?php
	if(isset($_POST['submit'])){
		$nama_kabupaten=$_POST['nama_kabupaten'];
		if ($nama_kabupaten=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$cek = mysqli_query($koneksi, "SELECT count(id_kabupaten) FROM tkabupaten");
			$dcek= mysqli_fetch_array($cek);
			if ($dcek[0]=="0") {
				mysqli_query($koneksi, "INSERT INTO tkabupaten VALUES('K-001','$nama_kabupaten')");
				?>
					<script language="javascript">document.location.href="?module=kabupaten"</script>
				<?php
			}else{
				$in = mysqli_query($koneksi, "SELECT id_kabupaten FROM tkabupaten ORDER BY id_kabupaten DESC");
				$ins= mysqli_fetch_array($in);
				$id_kab = substr($ins["id_kabupaten"], -2)+1;
				if ($id_kab>99) {
					$id_kabupaten = "".$id_kab;
				}elseif ($id_kab>9){
					$id_kabupaten = "0".$id_kab;
				}else{
					$id_kabupaten = "00".$id_kab;
				}
				mysqli_query($koneksi, "INSERT INTO tkabupaten VALUES('K-$id_kabupaten','$nama_kabupaten')");
				?>
					<script language="javascript">document.location.href="?module=kabupaten"</script>
				<?php
			}
		}
	}

	if (isset($_POST['update'])){
		if ($_POST[nama_kabupaten]=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$query=mysqli_query($koneksi, "UPDATE tkabupaten SET nama_kabupaten='$_POST[nama_kabupaten]' WHERE id_kabupaten='$_POST[id]'");
		}
	}

	if(isset($_GET['mode'])=='delete'){
		 $id_kabupaten=$_GET['id_kabupaten'];
		 mysqli_query($koneksi, "delete from tkabupaten where id_kabupaten='$id_kabupaten'");
	}

switch($_GET[act]){
	default:
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA KABUPATEN</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=kabupaten" method="post">
					<div class="form-group">
						<label for="nama_kabupaten">NAMA KABUPATEN</label>
						<input type="text" id="nama_kabupaten" name="nama_kabupaten" value="" placeholder="nama kabupaten" class="form-control">
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
								<th>Id Kabupaten</th>
								<th>Nama Kabupaten</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=$koneksi->query("SELECT * FROM tkabupaten");
								$no=1;
								while ($data=$query->fetch_assoc()) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_kabupaten] ?></td>
								<td><?php echo $data[nama_kabupaten] ?></td>
								<td>
									<a href="?module=kabupaten&act=update&id_kabupaten=<?php echo $data['id_kabupaten'];?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=kabupaten&mode=delete&id_kabupaten=<?php echo $data['id_kabupaten'];?>" onClick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
$edit=mysqli_query($koneksi,"SELECT * FROM tkabupaten WHERE id_kabupaten='$_GET[id_kabupaten]'");
$data=mysqli_fetch_array($edit);
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA KABUPATEN</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=kabupaten" method="post">
					<input type="hidden" name="id" value="<?php echo $data[id_kabupaten] ?>" placeholder="">
					<div class="form-group">
						<label for="">NAMA KABUPATEN</label>
						<input type="text" name="nama_kabupaten" value="<?php echo $data[nama_kabupaten] ?>" placeholder="nama kabupaten" class="form-control">
					</div>
					<button type="button" class="btn btn-success" onclick="self.history.back()">Cancel</button>
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
								<th>Id Kabupaten</th>
								<th>Nama Kabupaten</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM tkabupaten");
								$no=1;
								while ($data=mysqli_fetch_array($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_kabupaten] ?></td>
								<td><?php echo $data[nama_kabupaten] ?></td>
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
