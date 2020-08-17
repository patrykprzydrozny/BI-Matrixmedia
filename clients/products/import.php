<?php
include 'action.php';
function queryBuyPrice($ean, $buyPrice){
$query = "Insert INTO PRODUCTS_PRICES (ean, buy_price, date) VALUES ($ean, $buyPrice, NOW()) ; "; 
return $query;
}

function checkFile(){
    if (!isset($_FILES['upexcel']['tmp_name']) || !in_array($_FILES['upexcel']['type'], [
        'text/x-comma-separated-values', 
        'text/comma-separated-values', 
        'text/x-csv', 
        'text/csv', 
        'text/plain',
        'application/octet-stream', 
        'application/vnd.ms-excel', 
        'application/x-csv', 
        'application/csv', 
        'application/excel', 
        'application/vnd.msexcel', 
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ])) {
     die("Invalid file type");
    }  
}
checkFile();
require 'vendor/autoload.php';
switch(pathinfo($_FILES['upexcel']['name'], PATHINFO_EXTENSION))
    {
        case 'csv': $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        break;
        case 'xlsx': $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        break;
        case 'xls': $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        break;    
}
$spreadsheet = $reader->load($_FILES['upexcel']['tmp_name']);
$worksheet = $spreadsheet->getActiveSheet();
foreach ($worksheet->getRowIterator() as $row) {
  $cellIterator = $row->getCellIterator();
  $cellIterator->setIterateOnlyExistingCells(false);
  $data = [];
  foreach ($cellIterator as $cell) {
    $data[] = $cell->getValue();
  }
$tmp = queryBuyPrice($data[0],$data[1]);
if(goQuery($tmp) == true){
		header("Location: http://bi.matrixmedia.pl/clients/products");
}
else {
		die('Bład');
}

}


?>