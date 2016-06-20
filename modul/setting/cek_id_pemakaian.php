<?php
include '../../config/koneksi.php';
$nomor_berita_acara_pemakaian = $_GET['nomor_berita_acara_pemakaian'];

$cek = mysql_query("select * from pemakaian_aset where nomor_berita_acara_pemakaian = '$nomor_berita_acara_pemakaian'");
$jumlah = mysql_num_rows($cek);
$jumlah_id = ceil($jumlah);
if ($jumlah_id <> '0') {
	echo'	
		<p style="font-family: verdana; color: red;">Nomor Berita Acara Pemakaian '.$nomor_berita_acara_pemakaian.' Sudah Ada!</p>
		<script type="text/javascript">document.getElementById("submit").disabled = true;</script>
	';
}else {
	echo'
		<i class="fa fa-check"></i>
		<script type="text/javascript">document.getElementById("submit").disabled = false;</script>
	';
}
?>