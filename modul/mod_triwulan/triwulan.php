<?php
	if (isset($_POST['submit'])) {
		$nama_triwulan=$_POST['nama_triwulan'];
		$tahun 		  =$_POST['tahun'];
		if ($nama_triwulan=="" OR $tahun=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$cek = mysqli_query($koneksi, "SELECT count(id_triwulan) FROM ttriwulan");
			$dcek= mysqli_fetch_array($cek);
			if ($dcek[0]=="0") {
				mysqli_query($koneksi, "INSERT INTO ttriwulan VALUES ('T-001','$nama_triwulan','$tahun')");
				?>
					<script language="javascript">document.location.href="?module=triwulan"</script>
				<?php
			}else{
				$in = mysqli_query($koneksi, "SELECT id_triwulan FROM ttriwulan ORDER BY id_triwulan DESC");
				$ins= mysqli_fetch_array($in);
				$id_wulan = substr($ins["id_triwulan"], -2)+1;
				if ($id_wulan>99) {
					$id_triwulan = "".$id_wulan;
				}elseif ($id_wulan>9){
					$id_triwulan = "0".$id_wulan;
				}else{
					$id_triwulan = "00".$id_wulan;
				}
				mysqli_query($koneksi, "INSERT INTO ttriwulan VALUES ('T-$id_triwulan','$nama_triwulan','$tahun')");
				?>
					<script language="javascript">document.location.href="?module=triwulan"</script>
				<?php
			}
		}
	}

	if (isset($_POST['update'])) {
		if ($_POST[nama_triwulan]=="" OR $_POST[tahun]=="") {
		?>
			<script>alert("Data tidak boleh kosong")</script>
		<?php
		}else{
			$query = mysqli_query($koneksi, "UPDATE ttriwulan SET nama_triwulan='$_POST[nama_triwulan]', tahun='$_POST[tahun]' WHERE id_triwulan='$_POST[id]'");

			if($query){
			?>
				<script language="javascript">document.location.href="?module=triwulan"</script>
			<?php
			}else{
			?>
				<script type="text/javascript">alert("Terdapat data ID yang sama")</script>
			<?php
			}
		}
	}

	if (isset($_GET['mode'])=='delete') {
		mysqli_query($koneksi, "DELETE FROM ttriwulan WHERE id_triwulan='$_GET[id_triwulan]'");
	}

switch ($_GET[act]) {
	default:
?>	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA TRIWULAN</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=triwulan" method="post">
					<div class="form-group">
						<label for="">NAMA TRIWULAN</label>
						<input type="text" name="nama_triwulan" value="" placeholder="nama triwulan" class="form-control">
					</div>
					<div class="form-group">
						<label for="">TAHUN</label>
						<input type="text" name="tahun" class="form-control" placeholder="tahun">
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
								<th>Id Triwulan</th>
								<th>Nama Triwulan</th>
								<th>Tahun</th>
								<th width="40px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM ttriwulan ORDER BY id_triwulan ASC");
								$no=1;
								while ($data=mysqli_fetch_array($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_triwulan] ?></td>
								<td><?php echo $data[nama_triwulan] ?></td>
								<td><?php echo $data[tahun] ?></td>
								<td>
									<a href="?module=triwulan&act=update&id_triwulan=<?php echo $data[id_triwulan] ?>"><span class="glyphicon glyphicon-edit"></a></span>
									<a href="?module=triwulan&mode=delete&id_triwulan=<?php echo $data[id_triwulan] ?>" onclick="return confirm('Apakah Anda Yakin ?')"><span class="glyphicon glyphicon-trash"></a></span>
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
$query=mysqli_query($koneksi, "SELECT * FROM ttriwulan WHERE id_triwulan='$_GET[id_triwulan]'");
$data=mysqli_fetch_array($query);
?>
<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="judul">
					<span>DATA TRIWULAN</span>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-xs-12 col-md-6 col-sm-6">
				<form class="" action="?module=triwulan" method="post">
					<input type="hidden" name="id" value="<?php echo $data[id_triwulan] ?>" placeholder="">
					<div class="form-group">
						<label for="">NAMA TRIWULAN</label>
						<input type="text" name="nama_triwulan" placeholder="nama triwulan" class="form-control" value="<?php echo $data[nama_triwulan] ?>">
					</div>
					<div class="form-group">
						<label for="">TAHUN</label>
						<input type="text" name="tahun" class="form-control" placeholder="tahun" value="<?php echo $data[tahun] ?>">
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
								<th>Id Triwulan</th>
								<th>Nama Triwulan</th>
								<th>Tahun</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query=mysqli_query($koneksi, "SELECT * FROM ttriwulan ORDER BY id_triwulan ASC");
								$no=1;
								while ($data=mysqli_fetch_array($query)) {
							?>
							<tr>
								<td><?php echo $no ?></td>
								<td><?php echo $data[id_triwulan] ?></td>
								<td><?php echo $data[nama_triwulan] ?></td>
								<td><?php echo $data[tahun] ?></td>
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