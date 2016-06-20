<?php
include '../../config/koneksi.php';
$nomor_berita_acara_penerimaan = $_GET['nomor_berita_acara_penerimaan'];

$cek = mysql_query("select * from penerimaan_aset where nomor_berita_acara_penerimaan = '$nomor_berita_acara_penerimaan'");
$jumlah = mysql_num_rows($cek);
$jumlah_id = ceil($jumlah);
if ($jumlah_id <> '0') {
	echo'	
		<p style="font-family: verdana; color: red;">Nomor Berita Acara Penerimaan '.$nomor_berita_acara_penerimaan.' Sudah Ada!</p>
		<script type="text/javascript">document.getElementById("submit").disabled = true;</script>
	';
}else {
	echo'
		<i class="fa fa-check"></i>
		<script type="text/javascript">document.getElementById("submit").disabled = false;</script>
	';
}
?>