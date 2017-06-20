<?php
    /*
     * Script:    DataTables server-side script for PHP and MySQL
     */
    /* Database connection information */
        define('DB_HOST','localhost');
        define('DB_USER','root');
        define('DB_PASS','mars2017');
        define('DB_NAME','local_gh3');
ini_set('memory_limit', '-1');
set_time_limit(0);


    $database = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME  );
	$database->set_charset('utf8mb4');
/* 
    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
*/
//$table = 'station_inventory';
//$column = 'CLONE_OF';
//$column2 = 'CLONE_OF';
//$item = 'CCN51';
//$item2 = 'CCN51';
//$logi = 'or';

$table = $_POST['table'];
$column_names = $_POST['column_names'];
$item = $_POST['item'];    
$column =$_POST['column'];
$logi = $_POST['logi'];
$item2 = $_POST['item2'];
$column2 = $_POST['column2'];
$bool = '';
if($logi == 'not'){
	$bool = 'not'; 
	$logi = 'and';


}





if(($item == 'all' && $logi == 'or' )|| ($item2 == 'all' && $logi == 'or' ) || ($item == 'all' && $logi == 'na' )  ){
 $tQuery = "SELECT *  FROM $table " ;
}
else if ($item == 'all' && $logi == 'and' ){
$tQuery = "SELECT *  FROM $table where  `$column2` like '%$item2%'  " ;
}

else if (($item == 'all') &&( $bool == 'not')){
$tQuery = "SELECT *  FROM $table where  `$column2` NOT like '%$item2%' " ;
}

else if (($item2 == 'all') ||( $logi == 'na') || ($item2 == '')){
$tQuery = "SELECT *  FROM $table where  `$column` like '%$item%' " ;
}

else{ 
$tQuery = "SELECT *  FROM $table where `$column` like '%$item%' $logi `$column2` $bool like '%$item2%'  " ;
}	
	//$tQuery = "SELECT * from $table";
	$result = mysqli_query($database,$tQuery);
	$length = mysqli_field_count($database);
	$length2 =0;
	for($i= 0; $i<$length ;$i++){
        $name = mysqli_fetch_field_direct($result,$i) ->name;
	//if(in_array($name, $column_names)){
		$names[] = $name;
	//$length2++;
	//}
	}
	$i=0;
	foreach($column_names as $ele){
	if(in_array($ele, $names)){
	$column_names2[$i] = $ele; 
	$i++;
	}
	}
	$size = sizeof($column_names2);
	while($row = mysqli_fetch_array($result)){
		$arows = array();
		for ( $i=0 ; $i<$size ; $i++ ){
				$arow  = $row[$column_names2[$i]];
				$arows[] = $arow;
		}
	$output_f[]  = $arows;
	$output['aaData'][] = $arows;
	}
	echo json_encode($output);
$time = time();
$out = fopen("../files/current_data.csv", 'w');
fputcsv($out, $column_names2);
foreach ($output_f as $fields) {
    fputcsv($out, $fields);
}

fclose($out);
	









?>
