<?php

function csvToJson($file){
    if (($handle = fopen($file, "r")) !== FALSE) {
        $csvs = [];
        while(! feof($handle)) {
           $csvs[] = fgetcsv($handle);
        }
        $datas = [];
        $columnNames = [];
        foreach ($csvs[0] as $singleCsv) {
            $columnNames[] = $singleCsv;
        }
        foreach ($csvs as $key => $csv) {
            if ($key === 0) {
                continue;
            }
            foreach ($columnNames as $columnKey => $columnName) {
                if(isset($key)){
                    $datas[$key-1][$columnName] = $csv[$columnKey];
                }
            }
        }
    $json = json_encode($datas);
    fclose($handle);
    $json = json_decode($json,true);
    return $json;
}
}
$userData = csvToJson('data.csv');

function findMostPopularModel($arr,$toPluck){
    $model = [];
    foreach($arr as $key => $value){
        $model[] = strtoupper(str_ireplace(array( '-',' '),'',$value[$toPluck]));
    }
    $popularModels = array_count_values($model);
    arsort($popularModels);
    return array_slice($popularModels,0,3);
    }
$bikes = findMostPopularModel($userData,'Model');

