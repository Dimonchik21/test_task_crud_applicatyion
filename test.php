<!doctype>
<html>
<head>
</head>
<body>
<?php

//require_once('vendor/pclzip/pclzip/pclzip.lib.php');

require_once 'vendor/box/spout/src/Spout/Autoloader/autoload.php';


use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

$filePath = 'pegawai baru2.XLSX';

ini_set('max_execution_time', 1800);

$reader = ReaderFactory::create(Type::XLSX); // for XLSX files
//$reader = ReaderFactory::create(Type::CSV); // for CSV files
//$reader = ReaderFactory::create(Type::ODS); // for ODS files

$reader->open($filePath);

$i = 0;

$start = microtime(true);

foreach ($reader->getSheetIterator() as $sheet) {
    foreach ($sheet->getRowIterator() as $row) {


        $i++;

        echo $row[0] . "<br/>";

        if ($i == 7521) {
            // if($i == 10){
            $time_elapsed_secs = microtime(true) - $start;
            echo "<br/><br/><br/>TOTAL TIME : " . $time_elapsed_secs;
            die;
        }

    }
}

$reader->close();


function r($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function d($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

?>

</body>
</html>
