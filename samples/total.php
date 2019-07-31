<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */
require_once 'config.php';

$data = $db->total(
    array(
        'table' => 'test',
        'id' => 'id', // Primary ID name
        'joins' => NULL, // array(array('table' => 'ANOTHER_TABLE_NAME','alias' => 'A','type' => 'INNER','condition' => 'A.key = T.key'))
        'where' => array(
            array(
                'key' => 'is_active', //column name
                'values' => 1, // value/array,
                'condition' => 'AND'
            ),
            array(
                'key' => 'created_at', //column name
                'values' => array('2018-11-01 00:00:00', '2019-02-01 23:59:59'),
                'operator' => 'between'
            )
        )
    )
);

echo '<pre>';
print_r($data);