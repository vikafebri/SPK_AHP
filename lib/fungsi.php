<?php 

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
	
	 function tanggalindo($data)
	 {
		$th = substr($data, 0, -6);
		$tgl = substr($data,  -2);
		$bln = substr($data,5, -3);
		
		$tglindo = $tgl.' '.bln($bln).' '.$th;
		 return $tglindo;
	}
	
		function bln($bln){
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

				function bln_small($bln){
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


?>