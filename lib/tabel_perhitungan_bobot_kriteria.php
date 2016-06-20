<?php			
echo'<h4>Kriteria</h4>';
function tampilbaris($arr){
	echo '<table class="table table-bordered table-striped">';
	echo '<tr>';
	for ($i=0;$i<count($arr);$i++){
		echo '<td>'.$arr[$i].'</td>';
	}
	echo "</tr>";
	echo '</table>';
}
echo''.tampilbaris($kriteria).'<hr>';	

echo'<h4>Nilai Kepentingan Kriteria (Bentuk Desimal)</h4>';
function tampiltabel($arr){
	echo '<table class="table table-bordered table-striped">';
	for ($i=0;$i<count($arr);$i++){
	echo '<tr>';
		for ($j=0;$j<count($arr[$i]);$j++){
			echo '<td>'.$arr[$i][$j].'</td>';
		 }
		echo '</tr>';
	}
	echo '</table>';
}	
echo''.tampiltabel($k).'<hr>';

echo'<h4>Jumlah Baris Nilai Kepentingan Kriteria</h4>';
echo''.tampilbaris($jk).'<hr>';

echo'<h4>Nilai Kepentingan/ Jumlah Baris Nilai Kepentingan Kriteria</h4>';
echo''.tampiltabel($nk).'<hr>';

echo'<h4>Jumlah Kolom (Nilai Kepentingan/ Jumlah Baris Nilai Kepentingan Kriteria)</h4>';
function tampilkolom($arr){
	echo '<table class="table table-bordered table-striped">';
	for ($i=0;$i<count($arr);$i++){
		echo '<tr>';
		echo '<td>'.$arr[$i].'</td>';
		echo "</tr>";
	}
		echo '</table>';
}
echo''.tampilkolom($jnk).'<hr>';																									

echo'<h4>Nilai Eigen (Bobot Kriteria)</h4>';
echo''.tampilkolom($w).'<hr>';

echo'<h4>WSV</h4>';
echo''.tampilkolom($kw).'<hr>';

echo'<h4>λ</h4>';
echo'<table class="table table-bordered table-striped"><tr><td>'.$t.'</td></tr></table><hr>';

echo'<h4>CI</h4>';
echo'<table class="table table-bordered table-striped"><tr><td>'.$ci.'</td></tr></table><hr>';

echo'<h4>CR</h4>';
echo'<table class="table table-bordered table-striped"><tr><td>'.$cr.'</td></tr></table><hr>';
?>