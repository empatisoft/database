<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */
require_once 'config.php';

$data = $db->next(
    array(
        'table' => 'test', // TABLE_NAME as T
        'id' => 'id', // Primary ID name
        'current' => 5, // Current data id
        'columns' => '*', // not set: *
        'joins' => NULL, // array(array('table' => 'ANOTHER_TABLE_NAME','alias' => 'A','type' => 'INNER','condition' => 'A.key = T.key'))
        'where' => array(
            array(
                'key' => 'is_active', //column name
                'values' => 0, // value/array
                'condition' => 'AND'
            )
        ),
        'array' => false, // not set or false: object
    )
);

echo '<pre>';
print_r($data);