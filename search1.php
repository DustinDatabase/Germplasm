<?php



$table  = $_POST['table'];
#$table = "station_inventory";
if ($table  == "station_inventory"){ 

	$column = array("all","MITC_NUMBER","CLONE_OF","GENUS","SPECIES","ROOM","ROW","POINT","TREE_NUMBER","NEXT_LOCATION","MOTHER","FATHER","CROSS","STATUS","OFFTYPE","GENOTYPED_SAMPLE_TC","OFFTYPE_REFERENCE_TC","COUNTRY_OF_ORIGIN","INSTITUTE","ROOTSTOCK","GRAFTING_METHOD","DATE_GRAFTED","GRAFTER","IMPORT_PERMIT","ALIAS_OR_OTHER_ID","RUQ_NUMBER","GRIN_GLOBAL_NUMBER","NFC_TAG_ADDED","SI_CODE","203_Allele_1","203_Allele_2","208_Allele_1","208_Allele_2","COMMENTS");
}
if ($table  == "sample"){
	$column = array("all","TC_number","Unique Identifier","Species","Clone_of","Project","Mother","Father","Country","Institution","Farm","Field/Greenhouse","Block","Rep/Parcel","Row","Column","Tree/Plant");  
}

//echo "<option value = 'null'> Please select </option>";
//echo "<option value = '*'> ALL</option>";
//foreach ($column as $value){
		//echo "<option value = $value> $value</option>";

//}
//$column = json_encode($column);

echo json_encode($column);
?>





