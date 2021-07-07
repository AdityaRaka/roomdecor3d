<?php
  include '../controller/connect.php';
  session_start();

function pp($arr){
    echo "<pre>".print_r($arr,true)."</pre>";
}

function dd($arr){
    echo json_encode($arr);
}

function loadData($fromJSON = false)
{
	$data = [
		['id_perabot'=>1,'dataSet'=>['heim','studio','oda','sofa','bed','biru']],
		['id_perabot'=>2,'dataSet'=>['heim','studio','hara','sofa','duduk','biru']],
		['id_perabot'=>3,'dataSet'=>['heim','studio','hiro','sofa','seater','abuabu']],
		['id_perabot'=>4,'dataSet'=>['heim','studio','saki','sofa','bed','abuabu','muda']],
		['id_perabot'=>5,'dataSet'=>['ezma','olaf','sofa','duduk','biru']],
	];
	if ($fromJSON) {
		$data = json_decode(file_get_contents('./data.json'));
		$data=array_map(function ($x)
		{
			$x = (array)$x;
			$x['dataSet']=array_unique(array_merge($x['dataSet']->brand,$x['dataSet']->nama));
			return $x;
		},$data);
	}
	return $data;
}

function getTerm($data)
{

	$result = array_column($data,'dataSet');
	$result = array_merge(...$result);
	return array_values(array_unique($result));
}

function tf($data, $term, $q)
{
	$result = [];
	foreach ($term as $keyTerm => $valTerm) {
		// start TF //
		$perkata =[];
		$qvalue = in_array($valTerm, $q);
		$perkata['key'] =$valTerm;
		$perkata['tf'][] = [
				'name'=>'q',
				'value' => $qvalue ? 1: 0,
			];
		foreach ($data as $keyData => $valData) {
			$value = in_array($valTerm, $valData['dataSet']);
			$perkata['tf'][] = [
				'name'=>$valData['id_perabot'],
				'value' => $value ? 1: 0,
			];
		}
		// end TF //
		$df = array_sum(array_column(array_slice($perkata['tf'],1),'value'));
		$perkata['df']=$df;
		$ddf = count($data)/$df;
		$perkata['d/df']=$ddf;
		$logndf = log10($ddf);
		$perkata['log(n/df)']=$logndf;
		$result[]=$perkata;
	}

	return $result;
}
function tfidf($data)
{
	return array_map(function ($valData)
	{
		$result = [];
		$resultQ = [];
		$resultQ2 = [];
		$resultPV = [];
		$q = 0;
		$q2 = 0;
		foreach ($valData['tf'] as $key => $value) {
			$tfidfVal = $value['value']*$valData['log(n/df)'];
			$pvVal = pow($tfidfVal,2);
			if ($key === 0) {
				$q = $tfidfVal;
				$q2 = $pvVal;
			}
			$value['value'] = $tfidfVal;
			$result[]=$value;
			$resultQ[]=['name'=>$value['name'],'value'=>$q*$tfidfVal];
			$resultPV[]=['name'=>$value['name'],'value'=>$pvVal];
			$q2Val = $key > 0?$q2 * $pvVal: 0;
			$resultQ2[]=['name'=>$value['name'],'value'=>$q2Val];
		}
		$valData['tfidf'] = $result;
		$valData['QWDI'] = $resultQ;
		$valData['QWDI2'] = $resultQ2;
		$valData['panjangVektor'] = $resultPV;
		return $valData;
	}, $data);

}
function getTotal($data)
{
	$result=[];
	$tfidf = array_merge(...array_column($data, 'tfidf'));
	$qwdi = array_merge(...array_column($data, 'QWDI'));
	$qwdi2 = array_merge(...array_column($data, 'QWDI2'));
	$pv = array_merge(...array_column($data, 'panjangVektor'));
	$counter = [];
	foreach ($qwdi as $keyData => $valData) {
		$valDataPV = $pv[$keyData];
		$valDataTfidf = $tfidf[$keyData];
		$valDataQWDI2 = $qwdi2[$keyData];

		if ($counter[$valDataTfidf['name']] <= 5 || $valDataTfidf['name'] ==='q') {// 5 krena di excel ada 6
			$result['totalTfidfRank'][$valDataTfidf['name']] +=$valDataTfidf['value'];
			$counter[$valDataTfidf['name']]++;
		}
		$result['totalTfidf'][$valDataTfidf['name']] +=$valDataTfidf['value'];
		$result['totalQWDI'][$valData['name']] +=$valData['value'];
		$result['totalQWDI2'][$valDataQWDI2['name']] +=$valDataQWDI2['value'];
		$result['totalPV'][$valDataPV['name']] +=$valDataPV['value'];
	}
	foreach ($result['totalPV'] as $key => $value) {
		$result['akarPV'][$key] =sqrt($value);
	}

	return $result;
}

function getRank($datas)
{
	$result = [];
	$tfidf = $datas['totalTfidfRank'];
	$akar = $datas['akarPV'];
	$qwdi = $datas['totalQWDI'];
	foreach ($datas['totalQWDI2'] as $keyDatas => $data) {
			$result['RankCosine'][$keyDatas] = $qwdi[$keyDatas]/($akar['q']*$akar[$keyDatas]);
			$result['RankTFidf'][$keyDatas] = $tfidf[$keyDatas];
		if ($keyDatas!== 'q') {
			$result['RankQWDIV2'][$keyDatas] = $data/($akar['q']*$akar[$keyDatas]);
		}
	}
	arsort($result['RankCosine']);
	arsort($result['RankQWDIV2']);
	arsort($result['RankTFidf']);
	return $result;
}

function tampilITF($datas)
{
	foreach ($datas as $keyDatas => $data) {
			foreach ($data as $keyData => $valData) {
				if (!is_array($valData)) {
					echo $keyData."\t:".$valData."<br>";
				} else {
					echo $keyData.":<br>";
					foreach ($valData as $keytf => $valtf) {
						echo "&nbsp&nbsp&nbsp&nbsp".$valtf['name'].'='.number_format($valtf['value'],5)."<br>";
					}
				}

			}
			echo "<br>============================================<br>";
		}	
}
function tampilTotal($datas)
{
	foreach ($datas as $keyDatas => $data) {
		echo $keyDatas.":<br>";
		foreach ($data as $keytotal => $valtotal) {
			echo "&nbsp&nbsp&nbsp&nbsp".$keytotal.'='.number_format($valtotal,5)."<br>";
		}
	}
}

function rankObject($datas, $limit = 10, $semua=[])
{
	$hasil = [];
	foreach ($datas as $keyData => $data) {
		$inside = [];
		$totalData = 0;
		foreach ($data as $key => $insideData) {
			if($totalData < $limit && !in_array($key,$semua[$keyData])){
				if($key !== 'q'){
					$semua[$keyData][]=$key;
					$inside[]=['rank'=>$totalData+1,'id_perabot'=>$key,'value'=>$insideData];
					$totalData++;					
				}
			}
		}
		$hasil[$keyData][]=$inside;
	}
	return [$hasil,$semua];
}


$data = loadData(true);
$term = getTerm($data);
// $query = ['heim','studio','oda','sofa','bed','biru'];
// $hasilTF = tf($data, $term, $query);
// $hasilTFIDF = tfidf($hasilTF);
// $QWDI = getTotal($hasilTFIDF);
// $QWDIRank = getRank($QWDI);
// $finalRank = rankObject($QWDIRank);

$id_member =$_SESSION['id_member']? $_SESSION['id_member']: 0;
$sqlPerabot = "SELECT dp.id_perabot,nama_perabot,brand_perabot, IF(f.id,true, false) as favorite 
from data_perabot dp 
inner join favorite f on dp.id_perabot = f.id_perabot and f.id_member=  $id_member
limit 10";
$result = mysqli_query($connect, $sqlPerabot);
$topTenLikeId = array();
if($result->num_rows > 0){
	while($row = mysqli_fetch_object($result)){
	  array_push($topTenLikeId, $row->id_perabot);
	}
}

$allQuery = [];
if (count($topTenLikeId)) {
	$angka = 30;
	$length = count($topTenLikeId);
	$pembagi = floor($angka/$length);
	$sisa = $angka%$length;
	$allDataId = array_column($data,'id_perabot');
	$totalData = 0;
	$semua = [];
	foreach ($topTenLikeId as $key => $id) {
		$limit =$pembagi;
		if ($key === count($topTenLikeId)-1) {
			$limit = $pembagi+$sisa;
		}
		$findIdx = array_search($id, $allDataId);
		$query=$data[$findIdx]['dataSet'];
		$hasilTF = tf($data, $term, $query);
		$hasilTFIDF = tfidf($hasilTF);
		$QWDI = getTotal($hasilTFIDF);
		$QWDIRank = getRank($QWDI);
		$rankObject=rankObject($QWDIRank,$limit,$semua);
		$finalRank = $rankObject[0];
		$semua = $rankObject[1];
		$allQuery[$id]=$finalRank['RankCosine'][0];
		$totalData+=count($finalRank['RankCosine'][0]);
	}
	include './saveRecomendation.php';
} else {
	if ($id_member) {
		echo 'belum ada like';
	}else{
		header("Location: ../login/index.php");
	}
}
// dd($allQuery);


// echo json_encode([$pembagi,$sisa]) ;

// dd($finalRank);
// tampilTotal($QWDI);
// pp($term);
// tampilITF($hasilTFIDF);
// pp($hasilTFIDF);
// header('Content-Type: application/json');
?>

