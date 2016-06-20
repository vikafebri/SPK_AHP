<?php
include '../../config/koneksi.php';
$id_kriteria = $_GET['id_kriteria'];
$kriteria = mysql_fetch_assoc(mysql_query("select * from kriteria where id_kriteria = '$id_kriteria'"));
$nama_kriteria = $kriteria['kriteria'];

$array_alternatif = array();
$alternatif = mysql_query("select * from alternatif order by id_alternatif");
while ($data_alternatif = mysql_fetch_array($alternatif)) {
		$array_alternatif[] = $data_alternatif['alternatif'];
}

if ($nama_kriteria == 'Bobot BAN-S/M') {
	echo'	
		<script type="text/javascript">
			document.getElementById("pertanyaan").disabled = true;
			document.getElementById("nilai").disabled = true;
		</script>
		<script type="text/javascript">
			document.getElementById("pertanyaan").type = "hidden"
			document.getElementById("nilai").type = "hidden"
		</script>
	';
	for ($g=0;$g<count($array_alternatif);$g++) {
	echo'
		<script type="text/javascript">
			document.getElementById("pertanyaan'.$g.'").type = "text"
			document.getElementById("nilai'.$g.'").type = "text"
		</script>
	';
	}
}
else {
	echo'	
		<script type="text/javascript">
			document.getElementById("pertanyaan").disabled = false;
			document.getElementById("nilai").disabled = false;
		</script>
		<script type="text/javascript">
			document.getElementById("pertanyaan").type = "text"
			document.getElementById("nilai").type = "text"
		</script>
	';
	for ($g=0;$g<count($array_alternatif);$g++) {
	echo'
		<script type="text/javascript">
			document.getElementById("pertanyaan'.$g.'").type = "hidden"
			document.getElementById("nilai'.$g.'").type = "hidden"
		</script>
	';
	}
}
?>