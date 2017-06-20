<?php

define('DB_HOST','localhost');
        define('DB_USER','root');
        define('DB_PASS','mars2017');
        define('DB_NAME','local_gh3');
 $database = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME  );

$table = $_POST['table'];
 
$column =$_POST['column'];
//$column  = 'CLONE_OF';
    	$sql = "SELECT DISTINCT `$column`  FROM $table";
	if ($column == 'all'){
	$rows[] = 'all';
	echo json_encode($rows);
	return ;
	}
	$results = mysqli_query($database,$sql);
	//$row = mysqli_fetch_all($results,MYSQLI_ASSOC);
	while($row = $results -> fetch_array(MYSQLI_NUM)){
		$rows[] =$row[0];
		$options .= "<option value = $row[0]> $row[0] </option>";

	}
	//echo $options ;

	echo json_encode($rows);
	//echo "<script type='text/javascript'>";
	//echo "var data = $options";
	//echo "</script>";	

?>


