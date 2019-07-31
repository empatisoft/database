<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */
require_once 'config.php';

$data = $db->row(
    array(
        'table' => 'test', // TABLE_NAME as T
        'columns' => '*', // not set: *
        'joins' => NULL, // array(array('table' => 'ANOTHER_TABLE_NAME','alias' => 'A','type' => 'INNER','condition' => 'A.key = T.key'))
        'where' => array(
            array(
                'key' => 'is_active', //column name
                'values' => 0, // value/array
                'condition' => 'AND'
            ),
            array(
                'key' => 'id', //column name
                'values' => 4 // value/array
            )
        ),
        'array' => false, // not set or false: object
        'order' => array()
    )
);

echo '<pre>';
print_r($data);