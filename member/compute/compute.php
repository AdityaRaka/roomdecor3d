<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Computing</title>
</head>
<body>
	<?php
  include '../controller/connect.php';
  $sql = "SELECT id_perabot,nama_perabot,brand_perabot FROM data_perabot";
  $result = mysqli_query($connect, $sql);
  if($result->num_rows > 0){
  	$items = array();
	while($row = mysqli_fetch_object($result)){
		array_push($items, $row);
	}
  }
  ?>
	<?php
		$dataJson = file_get_contents('./data.json');
		if ($dataJson!= json_encode($items)) {
			echo "UPDATEd";
			// file_put_contents('data.json', json_encode($items));
		}
	?>
<h1>Perhitungan</h1>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
	const data = <?=json_encode($items)?>

	console.log('DAta', data)

	// ------ Case Folding --------
	function case_folding(text) {
		return text.toLowerCase()
	}

	// ------ Tokenizing --------
	function remove_tweet_special(text) {
		text = text.replace(/\\t/," ").replace(/\\n/," ").replace(/\\u/," ").replace(/\\/,"")
	    // remove mention, link, hashtag
	    text = text.replace(/([@#][A-Za-z0-9]+)|(\w+:\/\/\S+)/," ")
	    // remove incomplete URL
	    text = text.replace("http://", " ").replace("https://", " ")
	    return text
	}

	function remove_number(text) {
		return text.replace(/\d+/g,' ')
	}

	function remove_punctuation(text) {
		text = text.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()+]/g,"")
		return text
	}

	function remove_whitespace_LT(text) {
		return text.replace(/^\s+|\s+$/g, '')
	}

	function remove_whitespace_multiple(text) {
		return text.replace(/\s+/g,' ')
	}

	function remove_single_char(text) {
		text = text.replace(/\b[a-zA-Z]\b/g,'')
		text = text.replace(/\s{2,}/g," ")//hapus spasi yg lebih dari 2

		return text
	}

	function word_tokenize_wrapper(text) {
		return text.split(' ')
	}

	function remove_stop_word(text) {
		const stop_word = ["yg", "dg", "rt", "dgn", "ny", "d", 'klo', 
                       'kalo', 'amp', 'biar', 'bikin', 'bilang', 
                       'gak', 'ga', 'krn', 'nya', 'nih', 'sih', 
                       'si', 'tau', 'tdk', 'tuh', 'utk', 'ya', 
                       'jd', 'jgn', 'sdh', 'aja', 'n', 't', 
                       'nyg', 'hehe', 'pen', 'u', 'nan', 'loh', 'rt',
                       '&amp', 'yah','cm','hl','uk','mm']
		for (var i = 0; i < stop_word.length; i++) {
			let re = new RegExp(`\\b${stop_word[i]}\\b`, 'gi');
			text = text.replace(re, '')
		}
		return text
	}

	function process(text){
		text = case_folding(text)
		text = remove_tweet_special(text)
		text = remove_number(text)
		text = remove_punctuation(text)
		text = remove_whitespace_LT(text)
		text = remove_whitespace_multiple(text)
		text = remove_single_char(text)
		text = remove_stop_word(text)
		text = remove_whitespace_LT(text)//double check
		text = word_tokenize_wrapper(text)
		
		return text
	}

	let hasil = []
	data.forEach( function(element, index) {
		let brand = process(element.brand_perabot)
		let nama = process(element.nama_perabot)


		hasil.push({id_perabot:element.id_perabot, dataSet:{brand,nama}})
	});
	console.log('Hasil',JSON.stringify(hasil) )
	localStorage.setItem('dataJson', JSON.stringify(hasil));
	var items = localStorage.getItem('dataJson')

	$.post('/compute/saveFile.php', {'items': JSON.parse(items)}, function(data){
		  alert('Login Successful.  Redirect to a different page or something here.');
		})
	// console.log('Hasil',hasil )
	// console.log('TEST', remove_stop_word('donati meja kerja kantor direktur hl uk xxcm'))

</script>
</html>