<?php
    /*
     * Script:    DataTables server-side script for PHP and MySQL
     * Copyright: 2010 - Allan Jardine, 2012 - Chris Wright
     * License:   GPL v2 or BSD (3-point)
     */
     
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    /* Database connection information */
        define('DB_HOST','localhost');
        define('DB_USER','root');
        define('DB_PASS','test1');
        define('DB_NAME','local_gh');



    $database = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME  );
/* 
    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
*/


$table = $_GET['table'];
$column_names = $_GET['column_names'];
$item = $GET_['item'];    
$column =$_GET['column'];
$table = "STATION_INVENTORY";
$item = "CCN_51";
$column = "CLONE_OF";
//$column_names = array("MITC","CLONE_OF","GENUS");
$column_names = array("MITC","ROOM","ROW","POINT","NEXT_LOCATION","GENUS","SPECIES","CLONE_OF","MOTHER","FATHER","STATUS","OFFTYPE","INSTITUTE","COUNTRY_OF_ORIGIN","RUQ","ALIAS_OR_OTHER_ID","COMMENTS","TREE_NUMBER");
//$column  = 'CLONE_OF';
        $tQuery = "SELECT *  FROM $table where $column like '%$item%'";
	//$tQuery = "SELECT * from $table";
	$result = mysqli_query($database,$tQuery);
	$length = mysqli_field_count($database);
	$length2 =0;
	for($i= 0; $i<$length ;$i++){
        $name = mysqli_fetch_field_direct($result,$i) ->name;
	if(in_array($name, $column_names)){
	$names[] = $name;
	$length2++;
	}
	}
	while($row = mysqli_fetch_array($result)){
		$arows = array();
		for ( $i=0 ; $i<$length2 ; $i++ ){
				$arow  = $row[$names[$i]];
				$arows[] = $arow;
		}
	$output['aaData'][] = $arows;
	}
	
	echo json_encode($output);
    

?>
