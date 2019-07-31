<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */
require_once 'config.php';

$data = $db->result(
    array(
        'table' => 'test',
        'columns' => '*', // not set: *
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
        ),
        'array' => false, // not set or false: object
        'order' => array('name' => 'ASC', 'created_at' => 'DESC'),
        'pagination' => true,
        'limit' => 2,
        'offset' => 0
    )
);

echo '<pre>';
print_r($data);