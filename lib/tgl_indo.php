<?php
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}
	 function rupiah($data)
	 {
		$rupiah = "";
		$jml = strlen($data);

		 while($jml > 3)
		 {
			$rupiah = "." . substr($data,-3) . $rupiah;
			$l = strlen($data) - 3;
			$data = substr($data,0,$l);
			$jml = strlen($data);
		 }
		 $rupiah = "Rp " . $data . $rupiah . ",-";
		 return $rupiah;
	}	
	function tgl($tgl){
			$tanggal = substr($tgl,8,2);
			return $tanggal;		 
	}
	
	function tgl_indo_small($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan_small(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}
	
	function bulan_small($tgl){
			$bulan = getBulan_small(substr($tgl,5,2));
			return $bulan;		 
	}

	function tgl_indo_full($ex){
			$pecah=explode(" ",$ex);
			$tgl=$pecah[0];
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$pecah[1].' WIB';		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			}

				function getBulan_small($bln){
				switch ($bln){
					case 1: 
						return "Jan";
						break;
					case 2:
						return "Feb";
						break;
					case 3:
						return "Mar";
						break;
					case 4:
						return "Apr";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Jun";
						break;
					case 7:
						return "Jul";
						break;
					case 8:
						return "Agu";
						break;
					case 9:
						return "Sep";
						break;
					case 10:
						return "Okt";
						break;
					case 11:
						return "Nov";
						break;
					case 12:
						return "Des";
						break;
				}
			}
			
		function getHari($hari){
				switch ($hari){
					case "Mon": 
						return "Senin";
						break;
					case "Tue":
						return "Selasa";
						break;
					case "Wed":
						return "Rabu";
						break;
					case "Thu":
						return "Kamis";
						break;
					case "Fri":
						return "Jumat";
						break;
					case "Sat":
						return "Sabtu";
						break;
					case "Sun":
						return "Minggu";
						break;
				}
			} 
			
		function getDateName($date){
$namahari = date('l', strtotime($date));
//Function date(String1, strtotime(String2)); adalah fungsi untuk mendapatkan nama hari
return hariIndo($namahari);
}

function hariIndo($x){
	switch($x)
	{
		case"Monday";
			return "Senin";
		break;
		case"Tuesday";
			return "Selasa";
		break;
		case"Wednesday";
			return "Rabu";
		break;
		case"Thursday";
			return "Kamis";
		break;
		case"Friday";
			return "Jum'at";
		break;
		case"Saturday";
			return "Sabtu";
		break;
		case"Sunday";
			return "Minggu";
		break;
	}
}
?>
