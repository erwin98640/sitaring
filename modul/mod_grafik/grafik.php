<script type="text/javascript">
  var chart1; // globally available
  $(document).ready(function() {
    chart1 = new Highcharts.Chart({
      chart: {
        renderTo: 'container',
        type: 'column'
      },   
        title: {
        text: 'Statistik Pertumbuhan'
      },
        xAxis: {
        categories: ['ID Pemetaan']
      },
        yAxis: {
          title: {
            text: 'Jumlah Pohon'
          }
      },
        series:[
          <?php
            $sql   = "SELECT id_pemetaan  FROM tpemetaan";
            $query = mysqli_query($koneksi, $sql);
            while($ret = mysqli_fetch_array($query)){
              $id_pemetaan=$ret['id_pemetaan'];                     
              $query_jumlah = mysqli_query($koneksi, "SELECT jumlah FROM tpemetaan WHERE id_pemetaan='$id_pemetaan'");
                while($data = mysqli_fetch_array($query_jumlah)){
                  $jumlah = $data['jumlah'];                 
                }             
                ?>
                {
                  name: '<?php echo $id_pemetaan; ?>',
                  data: [<?php echo $jumlah; ?>]
                },
                <?php
            }
          ?>
        ]
      });
   }); 
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="judul">
				<span>GRAFIK PEMETAAN</span>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<!-- <div class="col-lg-4 col-xs-12 col-md-4 col-sm-4">
			<form class="" action="?module=kabupaten" method="post">
				<div class="form-group">
					<label for="">TRIWULAN</label>
					<select class="form-control" name="triwulan">
						<?php
							$query=mysqli_query($koneksi, "SELECT * FROM ttriwulan ORDER BY id_triwulan ASC");
							while ($data=mysqli_fetch_array($query)) {
						?>
						<option value="<?php echo $data[nama_triwulan] ?>"><?php echo $data[nama_triwulan] ?></option>
						<?php
							}
						?>
					</select>
				</div>
		</div>
		<div class="col-lg-4 col-xs-12 col-md-4 col-sm-4">
			<form class="" action="?module=kabupaten" method="post">
				<div class="form-group">
					<label for="">KOMODITI</label>
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
			</form>
		</div>
		<div class="col-lg-4 col-xs-12 col-md-4 col-sm-4">
			<form class="" action="?module=kabupaten" method="post">
				<div class="form-group">
					<label for="">PENYAKIT</label>
					<select class="form-control" name="nama_komoditi">
						<?php
							$query=mysqli_query($koneksi, "SELECT * FROM tpenyakit ORDER BY id_penyakit ASC");
							while ($data=mysqli_fetch_array($query)) {
						?>
						<option value="<?php echo $data[nama_penyakit] ?>"><?php echo $data[nama_penyakit] ?></option>
						<?php
							}
						?>
					</select>
				</div>
			</form>
		</div>
	</div> -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<!-- <button type="submit" name="submit" class="btn btn-success">Go</button> -->
			<div id='container'></div>
		</div>
	</div>
</div>
