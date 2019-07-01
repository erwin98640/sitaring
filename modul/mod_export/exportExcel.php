<?php include "../../config/koneksi.php";
    $filename = "Export_excel.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\""); ?>
<table border="1">
    <tr class="success">
        <th class="text-center" style="vertical-align: middle;" rowspan="3">No</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3" colspan="3">Kode / Program dan Kegiatan</th>
        <th class="text-center" style="vertical-align: middle;" colspan="2">Uraian</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3">Pagu Anggaran</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3" colspan="2">Nomor dan Nilai Kontrak</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3">Pelaksana</th>
        <th class="text-center" style="vertical-align: middle;" colspan="5">Dimensi</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3">Jenis Pengadaan</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3">Waktu Pelaksanaan</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3">Status Kepemilikan</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3">Harga Perolehan <br>Rp.</th>
        <th class="text-center" style="vertical-align: middle;" colspan="3">Realisasi</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3">Lokasi</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3">Koordinat</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="3">Penanggung Jawab</th>
    </tr>
    <tr class="success">
        <th class="text-center" style="vertical-align: middle;" rowspan="2">Nama Pekerjaan</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="2">Thn Perolehan</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="2">Pjg</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="2">Lbr</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="2">T</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="2">Vol</th>
        <th class="text-center" style="vertical-align: middle;" rowspan="2">Sat.</th>
        <th class="text-center" style="vertical-align: middle;" colspan="2">Keuangan</th>
        <th>Fisik</th>
    </tr>
    <tr class="success">
        <th class="text-center">Rp.</th>
        <th class="text-center">(%)</th>
        <th class="text-center">(%)</th>
    </tr>
    <tr class="danger">
        <th class="text-center">1</th>
        <th class="text-center" colspan="3">2</th>
        <th class="text-center">3</th>
        <th class="text-center">4</th>
        <th class="text-center">5</th>
        <th class="text-center" colspan="2">6</th>
        <th class="text-center">7</th>
        <th class="text-center">8</th>
        <th class="text-center">9</th>
        <th class="text-center">10</th>
        <th class="text-center">11</th>
        <th class="text-center">12</th>
        <th class="text-center">13</th>
        <th class="text-center">14</th>
        <th class="text-center">15</th>
        <th class="text-center">16</th>
        <th class="text-center">17</th>
        <th class="text-center">18</th>
        <th class="text-center">19</th>
        <th class="text-center">20</th>
        <th class="text-center">21</th>
        <th class="text-center">22</th>
    </tr>
    <?php $query=mysqli_query($koneksi, "SELECT
        data_pekerjaan.id_pekerjaan,
        data_pekerjaan.kode,
        data_program.nama_program,
        data_pekerjaan.kegiatan,
        data_pekerjaan.nama_pekerjaan,
        data_pekerjaan.tahun_perolehan,
        data_pekerjaan.pagu_anggaran,
        data_pekerjaan.nomor_kontrak,
        data_pekerjaan.nilai_kontrak,
        data_pekerjaan.pelaksana,
        data_pekerjaan.panjang,
        data_pekerjaan.lebar,
        data_pekerjaan.tinggi,
        data_satuan.satuan,
        data_jenis_pengadaan.jenis_pengadaan,
        data_pekerjaan.waktu_pelaksanaan,
        data_pekerjaan.status_kepemilikan,
        data_pekerjaan.harga_perolehan,
        data_pekerjaan.realisasi_keuangan,
        data_pekerjaan.realisasi_fisik,
        data_pekerjaan.lokasi,
        data_pekerjaan.koordinat_x,
        data_pekerjaan.koordinat_y,
        data_bidang.nama_pendek_bidang,
        data_pekerjaan.image_1,
        data_pekerjaan.image_2,
        data_pekerjaan.image_3
    FROM
        data_pekerjaan INNER JOIN
        data_bidang On data_pekerjaan.penanggung_jawab = data_bidang.id_bidang Inner Join
        data_jenis_pengadaan On data_pekerjaan.jenis_pengadaan = data_jenis_pengadaan.id_jenis_pengadaan Inner Join
        data_program On data_pekerjaan.program = data_program.id_program Inner Join
        data_satuan On data_pekerjaan.satuan = data_satuan.id_satuan ORDER BY id_pekerjaan");
        $no=1;
        while ($data=mysqli_fetch_object($query)) { ?>
    <tr>
        <td class="text-center"><?php echo $no++ ?></td>
        <td class="text-nowrap"><?php echo $data->kode ?></td>
        <td><?php echo $data->nama_program ?></td>
        <td><?php echo $data->kegiatan ?></td>
        <td><?php echo $data->nama_pekerjaan ?></td>
        <td class="text-center"><?php echo $data->tahun_perolehan ?></td>
        <td><?php echo "Rp ".number_format($data->pagu_anggaran) ?></td>
        <td><?php echo $data->nomor_kontrak ?></td>
        <td class="text-right"><?php echo "Rp ".number_format($data->nilai_kontrak) ?></td>
        <td><?php echo $data->pelaksana ?></td>
        <td class="text-center"><?php echo $data->panjang ?></td>
        <td class="text-center"><?php echo $data->lebar ?></td>
        <td class="text-center"><?php echo $data->tinggi ?></td>
        <td class="text-center"><?php echo $data->panjang*$data->lebar*$data->tinggi ?></td>
        <td><?php echo $data->satuan ?></td>
        <td><?php echo $data->jenis_pengadaan ?></td>
        <td><?php echo $data->waktu_pelaksanaan ?></td>
        <td><?php echo $data->status_kepemilikan ?></td>
        <td class="text-right"><?php echo "Rp ".number_format($data->harga_perolehan) ?></td>
        <td class="text-right"><?php echo "Rp ".number_format($data->realisasi_keuangan) ?></td>
        <td class="text-center"><?php echo $retVal = ($data->realisasi_keuangan==0 OR $data->harga_perolehan==0) ? "0 " : ceil(($data->realisasi_keuangan/$data->harga_perolehan)*100),"%" ; ?></td>
        <td class="text-center"><?php echo $data->realisasi_fisik."%" ?></td>
        <td><?php echo $data->lokasi ?></td>
        <td><?php echo $data->koordinat_x."|".$data->koordinat_y ?></td>
        <td><?php echo $data->nama_pendek_bidang ?></td>
    </tr>
    <?php } ?>
</table>