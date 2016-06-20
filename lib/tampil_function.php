<?php 



function hasiltweetone($hasiltweet,$getid) {	
		
		echo'
			<div class="row" style="border-bottom:1px solid #ddd;padding:10px 0">
				<div class="col-sm-6">'.$hasiltweet[$getid]['dokuji'].'</div>
			</div>
		';
}


function katalebih($teks) {
	
	$kata       = explode(" ", $teks);	

	foreach ($kata as $key => $value) {
	$kataAsal = $value;
		if(cekKamus($value)){ // Cek Kamus
			$katabaru[]= $value; 
		}
		else {
			$huruf = str_split($value);
			
			foreach ($huruf as $key => $valuehuruf) {
				if ($huruf[$key]==$huruf[$key+1]) {
					unset($huruf[$key]);
				}
			}	
			$ceksm= implode("",$huruf);
			
			if(cekKamus($ceksm)){ // Cek Kamus
				$katabaru[]= $ceksm; // Jika Ada kembalikan	
			} else {
				$katabaru[]= $kataAsal;
			}
		
		}

	}
	$cteksbaru= implode(" ",$katabaru);
	return $cteksbaru;
}


function cekKamusNormalisasi($teks){
	$kata       = explode(" ", $teks);	
	
	$kamus    		= file_get_contents('../../lib/file-normalisasi.txt');
	$perkata        = explode(";", $kamus);	
	
	foreach ($perkata as $key => $value) {
			$k        = explode(":", $value);		
			$katanotnormal = trim($k[0]);
			$katanormal = trim($k[1]);
			$kamusnormalisasi[$katanormal] = $katanotnormal;
	}	
	
	foreach ($kata as $key => $value) {	
		$kataasal = $value;
		foreach ($kamusnormalisasi as $normakatakey => $normakatavalue ) {
			if ($value == $normakatavalue) {
				$kata[$key] = $normakatakey;
			} 	
		}
	}
	$cteksbaru= implode(" ",$kata);
	return $cteksbaru;
}

function huruf_kecil($teks) {
	
	$teks = strtolower(trim($teks));
	return $teks;
}

function steaming($stem){
			$teksAsli = $stem;	
			$length = strlen($teksAsli);

			$kata = '';

			if(preg_match('/([A-Za-z])/i',$teksAsli)){
				$kata = $teksAsli;		
				return $stemming = NAZIEF($stem);
				$kata = '';
			}	
}
function preprocessing($hasiltweet,$getid,$steam=false){
	  // -------------------------------------//
	 // -------- A. PRE - PROCESSING --------//
	// -------------------------------------//
	
	//0.persiapan 
		//$tweet_desc = $hasiltweet[$getid]['dokuji'];
		$tweet_desc = $hasiltweet[$getid]['dokuji'];
	
	//1. Case Folding & Remove Charachter, hashtag, username and link
		
		//perword	
		$tweet_desc = preg_replace("/((http)+(s)?:\/\/[^<>\s]+)/i", "", $tweet_desc );
		$tweet_desc = preg_replace("/[@]+([A-Za-z0-9-_]+)/", '', $tweet_desc );
		$tweet_desc = preg_replace("/[#]+([A-Za-z0-9-_]+)/", '', $tweet_desc );
		$tweet_desc = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $tweet_desc );
		$tweet_desc = preg_replace('/&#?[a-z0-9]{2,8};/i', '', $tweet_desc );
		//pergram
		$tweet_desc = str_replace(str_split('#"~!@$\%^&*()_+`=-<>?,./:{}[];\|'), ' ', $tweet_desc);
		$tweet_desc = str_replace("'", ' ', $tweet_desc);
		//huruf kecil					
		$tweet_desc = huruf_kecil($tweet_desc);	
	
	if ($steam === true) {
		//2. Steaming
			
			//Memecah dokumen menjadi kata
			$rows        = explode(" ", $tweet_desc);
					
			//Untuk setiap kata pada masing-masing dokumen diperiksa 
			foreach($rows as $key => $value) {
				$kata = steaming($value);
				$rows[$key] = $kata;		
			}
			
		//3. StopWords		
			
			//Mengambil stoplist
			$getstoplist    = file_get_contents('../../lib/file-stopword.txt');
			$stoplist        = explode(" ", $getstoplist);

			//Delete kata yang merupakan daftar stoplist
			$rows = array_diff($rows, $stoplist);		

			//Memperaharui dokumen
			$tweet_desc = implode(" ",$rows);		
	}
		
	//3. Normalisasi
		
		//Menjalankan fungsi pengecekan pemakaian huruf berlebihan
		$tweet_desc 		= katalebih($tweet_desc);
		//Menjalankan fungsi pengecekan kata singkatan dan kata moderen
		$tweet_desc 		= cekKamusNormalisasi($tweet_desc);
		
		return $tweet_desc;
}



function preprocessinglatih($hasillatih,$getid,$steam=false){
	  // -------------------------------------//
	 // -------- A. PRE - PROCESSING --------//
	// -------------------------------------//
	
	//0.persiapan 
		//$doklatih = $hasillatih[$getid]['dokuji'];
		$doklatih = $hasillatih[$getid]['doklatih'];
	
	//1. Case Folding & Remove Charachter, hashtag, username and link
		
		//perword	
		$doklatih = preg_replace("/((http)+(s)?:\/\/[^<>\s]+)/i", "", $doklatih );
		$doklatih = preg_replace("/[@]+([A-Za-z0-9-_]+)/", '', $doklatih );
		$doklatih = preg_replace("/[#]+([A-Za-z0-9-_]+)/", '', $doklatih );
		$doklatih = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $doklatih );
		$doklatih = preg_replace('/&#?[a-z0-9]{2,8};/i', '', $doklatih );
		//pergram
		$doklatih = str_replace(str_split('#"~!@$\%^&*()_+`=-<>?,./:{}[];\|'), ' ', $doklatih);
		$doklatih = str_replace("'", ' ', $doklatih);
		//huruf kecil					
		$doklatih = huruf_kecil($doklatih);	
	
	if ($steam === true) {
		//2. Steaming
			
			//Memecah dokumen menjadi kata
			$rows        = explode(" ", $doklatih);
					
			//Untuk setiap kata pada masing-masing dokumen diperiksa 
			foreach($rows as $key => $value) {
				$kata = steaming($value);
				$rows[$key] = $kata;		
			}
			
		//3. StopWords		
			
			//Mengambil stoplist
			$getstoplist    = file_get_contents('../../lib/file-stopword.txt');
			$stoplist        = explode(" ", $getstoplist);

			//Delete kata yang merupakan daftar stoplist
			$rows = array_diff($rows, $stoplist);		

			//Memperaharui dokumen
			$doklatih = implode(" ",$rows);		
	}
		
	//3. Normalisasi
		
		//Menjalankan fungsi pengecekan pemakaian huruf berlebihan
		$doklatih 		= katalebih($doklatih);
		//Menjalankan fungsi pengecekan kata singkatan dan kata moderen
		$doklatih 		= cekKamusNormalisasi($doklatih);
		
		return $doklatih;
}

function prosestraining($tweet_desc,$nilaik){

	$dt			   	 	= file_get_contents('../../lib/file-datalatih.txt');//mengambil data training
	$jmdt	         	= explode("\n", $dt);
	array_shift($jmdt);
	$jmdt2				= array_filter($jmdt);
	$jumlahdatalatih	= count($jmdt2);
	
	$txt_file   	 	= file_get_contents('../../lib/file-datalatih-index.txt');//mengambil data training
	$datadok         	= explode("\n", $txt_file);
	array_shift($datadok);
	$tweetpecah        	= explode(" ", $tweet_desc);
	$hitungtweet 	 	= array_count_values($tweetpecah);

	$jmdok=0;
	
	foreach ($datadok as $key => $value) {	$jmdok++;
		$a       		= explode(";", $value);
		$d        		= explode("/",$a[1]);	
		$df[$a[0]] 		= $a[2];
		
		foreach ($d as $c) {
	
			$e        	= explode(":",$c);
			if($e[0] 	!= NULL OR $e[0] != '') {
				$arrayDokk[$a[0]][$e[0]]['df']	= $e[1];
			}
		}
	}
	
	foreach ($hitungtweet as $key => $value) {
		$arrayDokk[$key]['Q']['df']	= $value;
	}	

	$no=0;
	foreach ($arrayDokk as $kata => $arrayb) {$no++;
		foreach ($arrayb as $key => $lagi) {
			if ($df[$kata] != NULL OR $df[$kata] != '') {
				$wdtd[$kata][$key]		= number_format(log10($jumlahdatalatih/$df[$kata]),3)*$arrayDokk[$kata][$key]['df'];					
				$jmKali[$key] 			+= number_format($wdtd[$kata]['Q']*$wdtd[$kata][$key],3);
				$jmPV[$key] 			+= number_format($wdtd[$kata][$key]*$wdtd[$kata][$key],3);
				$jmPVSQRT[$key]			= number_format(sqrt($jmPV[$key]),3);
				if ($jmPVSQRT['Q'] == NULL AND $jmKali[$key] == NULL) {
					$jmPVSQRT['Q']		= 1;
				} elseif ($jmPVSQRT['Q'] != NULL AND $jmKali[$key] == NULL) {
					$jmPVSQRT[$key] =1;
					$jmKali[$key] =0;
				}				
				$coskali[$key]			= number_format($jmPVSQRT['Q'] * $jmPVSQRT[$key], 3);			
				$cos[$key]				= number_format($jmKali[$key] / $coskali[$key], 3);			
			}		
		}	
	}
	
	arsort($cos);
	unset($cos['Q']);
	$KThree = array_slice($cos, 0, $nilaik);

	return $KThree;
}

function prosestrainingbiword($tweet_desc,$nilaik){
	$dt			   	 	= file_get_contents('../../lib/file-datalatih.txt');//mengambil data training
	$jmdt	         	= explode("\n", $dt);
	array_shift($jmdt);
	$jmdt2				= array_filter($jmdt);
	$jumlahdatalatih	= count($jmdt2);
	
	$txt_file   	 	= file_get_contents('../../lib/file-datalatih-indexbiword.txt');//mengambil data training
	$datadok         	= explode("\n", $txt_file);
	array_shift($datadok);
	$tweetpecah        	= explode(" ", $tweet_desc);
	$hitungtweet 	 	= array_count_values($tweetpecah);


	foreach ($datadok as $key => $value) {
		$a       		= explode(";", $value);
		$d        		= explode("/",$a[1]);	
		$df[$a[0]] 		= $a[2];
		
		foreach ($d as $c) {
			$e        	= explode(":",$c);
			if($e[0] 	!= NULL OR $e[0] != '') {
				$arrayDokk[$a[0]][$e[0]]['df']	= $e[1];
			}
		}
	}
	
	foreach ($hitungtweet as $key => $value) {
		$arrayDokk[$key]['Q']['df']	= $value;
	}	

	$no=0;
	foreach ($arrayDokk as $kata => $arrayb) {$no++;
		foreach ($arrayb as $key => $lagi) {
			if ($df[$kata] != NULL OR $df[$kata] != '') {
				$wdtd[$kata][$key]		= number_format(log10($jumlahdatalatih/$df[$kata]),3)*$arrayDokk[$kata][$key]['df'];					
				$jmKali[$key] 			+= number_format($wdtd[$kata]['Q']*$wdtd[$kata][$key],3);
				$jmPV[$key] 			+= number_format($wdtd[$kata][$key]*$wdtd[$kata][$key],3);
				$jmPVSQRT[$key]			= number_format(sqrt($jmPV[$key]),3);
				if ($jmPVSQRT['Q'] == NULL AND $jmKali[$key] == NULL) {
					$jmPVSQRT['Q']		= 1;
				} elseif ($jmPVSQRT['Q'] != NULL AND $jmKali[$key] == NULL) {
					$jmPVSQRT[$key] =1;
					$jmKali[$key] =0;
				}				
				$coskali[$key]			= number_format($jmPVSQRT['Q'] * $jmPVSQRT[$key], 3);			
				$cos[$key]				= number_format($jmKali[$key] / $coskali[$key], 3);			
			}		
		}	
	}

	arsort($cos);
	unset($cos['Q']);
	$KThree = array_slice($cos, 0, $nilaik);

	return $KThree;
}
		

?>