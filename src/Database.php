<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */

namespace Database;

use PDO;
use PDOException;

class Database {

    protected $db = null;
    private $strings = array(
        'table_na' => 'Lütfen tablo adını belirtiniz.',
        'table_not_exist' => 'Tablo bulunamadı.',
        'must_have_primary_id' => 'Birincil anahtar belirtilmelidir.',
        'must_have_current_id' => 'Geçerli kaydın anahtarı belirtilmelidir.',
        'must_have_fileds' => 'Güncellenecek kolon adları belirtilmelidir.'
    );

    /**
     * Db constructor.
     * @param $params
     *
     * Parametreler array veya object olarak gönderilebilir.
     */
    public function __construct($params)
    {
        if(is_array($params)) {
            $host = isset($params['host']) ? $params['host'] : NULL;
            $database = isset($params['database']) ? $params['database'] : NULL;
            $port = isset($params['port']) ? $params['port'] : 3306;
            $charset = isset($params['charset']) ? $params['charset'] : 'utf8';
            $user = isset($params['user']) ? $params['user'] : NULL;
            $password = isset($params['password']) ? $params['password'] : NULL;
        } else {
            $host = isset($params->host) ? $params->host : NULL;
            $database = isset($params->database) ? $params->database : NULL;
            $port = isset($params->port) ? $params->port : 3306;
            $charset = isset($params->charset) ? $params->charset : 'utf8';
            $user = isset($params->user) ? $params->user : NULL;
            $password = isset($params->password) ? $params->password : NULL;
        }

        $db = null;
        if ($db === null) {
            try
            {
                $dsn = 'mysql:host='.$host.';dbname='.$database.';port='.$port.';charset='.$charset;
                $db = new PDO($dsn, $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch (PDOException $e)
            {
                echo '<pre>';
                print_r($e->getMessage());
            }
        }
        $this->db = $db;

    }


    public function lastId() {
        return $this->db->lastInsertId();
    }

    /**
     * @param $params
     * @return array|string
     *
     * Koşula uyan tüm kayıtları listeler.
     */
    public function result($params) {
        try {

            $joins = isset($params['joins']) && is_array($params['joins']) && $params['joins'] != NULL ? $this->join($params['joins']) : NULL;
            $where = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->where($params['where']) : NULL;
            $columns = isset($params['columns']) && $params['columns'] != NULL ? $params['columns'] : '*';
            $table = isset($params['table']) && $params['table'] != NULL ? $params['table'] : NULL;
            $bindParams = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->params($params['where']) : NULL;
            $fetchMode = isset($params['array']) && $params['array'] == true ? PDO::FETCH_ASSOC : PDO::FETCH_OBJ;
            $orderBy = isset($params['order']) ? $this->order($params['order']) : '';
            $pagination = isset($params['pagination']) && $params['pagination'] == true ? true : false;
            $limit = isset($params['limit']) && $params['limit'] > 0 ? $params['limit'] : 10;
            $offset = isset($params['offset']) && $params['offset'] >= 0 ? $params['offset'] : 0;

            if($table == NULL) {
                die($this->strings['table_na']);
            }

            $query_string = 'SELECT '.$columns.' FROM '.$table.$joins.$where.$orderBy;

            if($pagination == true)
                $query_string .= ' LIMIT '.$offset.', '.$limit;

            $query = $this->db->prepare($query_string);
            $bindParams != NULL ? $query->execute($bindParams) : $query->execute();
            return $query->fetchAll($fetchMode);

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $params
     * @return mixed|string
     *
     * Toplam kayıt sayısını döndürür.
     */
    public function total($params) {
        try {

            $joins = isset($params['joins']) && is_array($params['joins']) && $params['joins'] != NULL ? $this->join($params['joins']) : NULL;
            $where = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->where($params['where']) : NULL;
            $table = isset($params['table']) && $params['table'] != NULL ? $params['table'] : NULL;
            $bindParams = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->params($params['where']) : NULL;
            $primaryId = isset($params['id']) ? $params['id'] : NULL;

            if($table == NULL) {
                die($this->strings['table_na']);
            }
            if($primaryId == NULL) {
                die($this->strings['must_have_primary_id']);
            }

            $query_string = 'SELECT COUNT('.$primaryId.') FROM ' . $table.$joins.$where;

            $query = $this->db->prepare($query_string);
            $bindParams != NULL ? $query->execute($bindParams) : $query->execute();
            return $query->fetch(PDO::FETCH_COLUMN);

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $params
     * @return mixed|string
     *
     * Tek satır veri döndürür.
     */
    public function row($params) {
        try {

            $joins = isset($params['joins']) && is_array($params['joins']) && $params['joins'] != NULL ? $this->join($params['joins']) : NULL;
            $where = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->where($params['where']) : NULL;
            $columns = isset($params['columns']) && $params['columns'] != NULL ? $params['columns'] : '*';
            $table = isset($params['table']) && $params['table'] != NULL ? $params['table'] : NULL;
            $bindParams = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->params($params['where']) : NULL;
            $fetchMode = isset($params['array']) && $params['array'] == true ? PDO::FETCH_ASSOC : PDO::FETCH_OBJ;
            $orderBy = isset($params['order']) ? $this->order($params['order']) : '';

            if($table == NULL) {
                die($this->strings['table_na']);
            }

            $query_string = 'SELECT '.$columns.' FROM '.$table.$joins.$where.$orderBy;

            $query = $this->db->prepare($query_string);
            $bindParams != NULL ? $query->execute($bindParams) : $query->execute();
            return $query->fetch($fetchMode);

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $params
     * @return mixed|string|null
     *
     * Önceki kaydı getirir.
     *
     * ÖRNEK:
     *
     * previous(array('table' => 'liste','id' => 'ID','current' => 8,'where' => array(array('key' => 'SIRA','values' => 0,'operator' => '>','condition' => 'AND'))))
     */
    public function previous($params) {
        try {

            $joins = isset($params['joins']) && is_array($params['joins']) && $params['joins'] != NULL ? $this->join($params['joins']) : NULL;
            $where = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->where($params['where']) : NULL;
            $columns = isset($params['columns']) && $params['columns'] != NULL ? $params['columns'] : '*';
            $table = isset($params['table']) && $params['table'] != NULL ? $params['table'] : NULL;
            $bindParams = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->params($params['where']) : NULL;
            $fetchMode = isset($params['array']) && $params['array'] == true ? PDO::FETCH_ASSOC : PDO::FETCH_OBJ;
            $primaryId = isset($params['id']) ? $params['id'] : NULL;
            $currentId = isset($params['current']) ? $params['current'] : NULL;

            if($table == NULL)
                die($this->strings['table_na']);

            if($primaryId == NULL)
                die($this->strings['must_have_primary_id']);

            if($currentId == NULL)
                die($this->strings['must_have_current_id']);

            if($where == NULL)
                $query_string = 'SELECT MAX('.$primaryId.') FROM '.$table.$joins.' WHERE '.$primaryId.' < :CURRENT_ID';
            else
                $query_string = 'SELECT MAX('.$primaryId.') FROM '.$table.$joins.$where.' '.$primaryId.' < :CURRENT_ID';

            $query = $this->db->prepare($query_string);
            $bindParams != NULL ? $query->execute(array_merge($bindParams, array(':CURRENT_ID' => $currentId))) : $query->execute(array(':CURRENT_ID' => $currentId));
            $prevId = $query->fetch(PDO::FETCH_COLUMN);

            $result = NULL;

            if($prevId != NULL) {
                $query_previous = $this->db->prepare('SELECT '.$columns.' FROM '.$table.$joins.' WHERE '.$primaryId.' = :PREV_ID');
                $query_previous->execute(array(
                    ':PREV_ID' => $prevId
                ));
                $result = $query_previous->fetch($fetchMode);
            }

            return $result;

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $params
     * @return mixed|string|null
     *
     * Sonraki kaydı getirir.
     *
     * ÖRNEK:
     *
     * next(array('table' => 'liste','id' => 'ID','current' => 8,'where' => array(array('key' => 'SIRA','values' => 0,'operator' => '>','condition' => 'AND'))))
     */
    public function next($params) {
        try {

            $joins = isset($params['joins']) && is_array($params['joins']) && $params['joins'] != NULL ? $this->join($params['joins']) : NULL;
            $where = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->where($params['where']) : NULL;
            $columns = isset($params['columns']) && $params['columns'] != NULL ? $params['columns'] : '*';
            $table = isset($params['table']) && $params['table'] != NULL ? $params['table'] : NULL;
            $bindParams = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->params($params['where']) : NULL;
            $fetchMode = isset($params['array']) && $params['array'] == true ? PDO::FETCH_ASSOC : PDO::FETCH_OBJ;
            $primaryId = isset($params['id']) ? $params['id'] : NULL;
            $currentId = isset($params['current']) ? $params['current'] : NULL;

            if($table == NULL)
                die($this->strings['table_na']);

            if($primaryId == NULL)
                die($this->strings['must_have_primary_id']);

            if($currentId == NULL)
                die($this->strings['must_have_current_id']);

            if($where == NULL)
                $query_string = 'SELECT MIN('.$primaryId.') FROM '.$table.$joins.' WHERE '.$primaryId.' > :CURRENT_ID';
            else
                $query_string = 'SELECT MIN('.$primaryId.') FROM '.$table.$joins.$where.' '.$primaryId.' > :CURRENT_ID';

            $query = $this->db->prepare($query_string);
            $bindParams != NULL ? $query->execute(array_merge($bindParams, array(':CURRENT_ID' => $currentId))) : $query->execute(array(':CURRENT_ID' => $currentId));
            $prevId = $query->fetch(PDO::FETCH_COLUMN);

            $result = NULL;

            if($prevId != NULL) {
                $query_previous = $this->db->prepare('SELECT '.$columns.' FROM '.$table.$joins.' WHERE '.$primaryId.' = :PREV_ID');
                $query_previous->execute(array(
                    ':PREV_ID' => $prevId
                ));
                $result = $query_previous->fetch($fetchMode);
            }

            return $result;

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $table
     * @param $values
     * @param bool $last_id
     * @return bool|string
     *
     * ÖRNEK KULLANIM:
     *
     * insert('liste', array('KIMLIK_NO' => '22324324'))
     */
    public function insert($table, $values, $last_id = false)
    {
        try {
            $values_string = "";
            $colums_string = "";
            $value_count = 0;
            foreach ($values as $key => $value)
            {
                if($value_count == 0)
                {
                    $colums_string = $key;
                    $values_string = ':' . $key;
                }
                else
                {
                    $colums_string = $colums_string . ', ' . $key;
                    $values_string = $values_string . ', :' . $key;
                }
                $value_count++;
            }
            $query_string = 'INSERT INTO ' . $table .' ('.$colums_string.') VALUES ('.$values_string.')';
            $query = $this->db->prepare($query_string);
            foreach ($values as $key => &$value)
            {
                $query->bindParam(':'.$key, $value);
            }
            $insert = $query->execute();

            return $last_id == true ? $this->db->lastInsertId() : $insert;

        } catch(PDOException $e) {
            trigger_error( $e->getMessage(), E_USER_ERROR);
        }
    }

    /**
     * @param $params
     * @return bool
     *
     * Güncelleme fonksiyonu
     *
     * ÖRNEK KULLANIM
     * update(array('table' => 'liste','fields' => array('ONAY_KODU' => 'ONUR KAYAxxx'),'where' => array(array('key' => 'ID','values' => 4,'condition' => 'AND'),array('key' => 'SIRA','values' => 2))//'joins' => array(array('table' => 'A','alias' => 'a','type' => 'INNER','condition' => 'a.key = b.key'))))
     */
    public function update($params)
    {
        try {
            $joins = isset($params['joins']) && is_array($params['joins']) && $params['joins'] != NULL ? $this->join($params['joins']) : NULL;
            $where = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->where($params['where']) : NULL;
            $table = isset($params['table']) && $params['table'] != NULL ? $params['table'] : NULL;
            $fields = isset($params['fields']) && $params['fields'] != NULL ? $this->fields($params['fields']) : NULL;
            $bindParams = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->params($params['where']) : NULL;

            if($table == NULL) {
                die($this->strings['table_na']);
            }
            if($fields == NULL) {
                die($this->strings['must_have_fileds']);
            }

            $values_string = "";
            $value_count = 0;
            foreach ($fields as $key => $value)
            {
                $values_string .= $value_count == 0 ? $key . ' = :' . $key : ', ' . $key . ' = :' . $key;
                $value_count++;
            }

            $query_string = 'UPDATE '.$table.$joins.' SET '.$values_string.' '.$where;

            $query = $this->db->prepare($query_string);
            $result = $bindParams != NULL && $fields != NULL ? $query->execute(array_merge($bindParams, $fields)) : $query->execute();
            return $result;

        } catch(PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    /**
     * @param $params
     * @return bool
     *
     * Silme fonksiyonu
     * ÖRNEK KULLANIM: delete(array('table' => 'liste','where' => array(array('key' => 'ID','values' => 12,'operator' => '>'))))
     */
    public function delete($params)
    {
        try {

            $where = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->where($params['where']) : NULL;
            $table = isset($params['table']) && $params['table'] != NULL ? $params['table'] : NULL;
            $bindParams = isset($params['where']) && is_array($params['where']) && $params['where'] != NULL ? $this->params($params['where']) : NULL;

            if($table == NULL) {
                die($this->strings['table_na']);
            }

            $query_string = 'DELETE FROM '.$table.$where;

            $query = $this->db->prepare($query_string);
            $result = $bindParams != NULL ? $query->execute($bindParams) : $query->execute();
            return $result;

        } catch(PDOException $e) {
            trigger_error( $e->getMessage(), E_USER_ERROR);
        }
    }

    /**
     * @param $params
     * @return string
     *
     * Dizi halinde sıralama parametreleri girilir.
     *
     * ÖRNEK: 'order' => array('ID' => 'ASC')
     */
    private function order($params) {
        $orderBy = '';

        if(!empty($params)) {
            $count = 0;
            foreach ($params as $key => $value) {
                $orderBy .= $count == 0 ? 'ORDER BY '.$key.' '.$value : ', '.$key.' '.$value;
                $count++;
            }
        }

        return $orderBy;
    }

    /**
     * @param $params
     * @return null
     *
     * UPDATE fonksiyonu için bind parametrelerini oluşturur.
     */
    private function fields($params) {

        $bindParams = array();
        $result = NULL;

        if($params != NULL) {
            foreach ($params as $key => $value) {
                $v = is_array($value) || is_object($value) ? json_encode($value, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) : $value;
                array_push($bindParams, array($key => $v));
            }

            if(!empty($bindParams)) {
                foreach ($bindParams as $key => $val) {
                    foreach ($val as $k => $v) {
                        $result[$k] = $v;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @param $params
     * @return array
     *
     * PDO sorgusuna BindParam değerlerini dizi olarak döndürür.
     */
    private function params($params) {

        $bindParams = array();
        $result = NULL;

        if($params != NULL) {
            foreach ($params as $param) {

                $key = isset($param['key']) ? $param['key'] : NULL;

                if($key != NULL) {

                    $values = isset($param['values']) ? $param['values'] : NULL;
                    $operator = isset($param['operator']) ? $param['operator'] : '=';

                    if($operator == 'null' || $operator == '!null')
                        continue;

                    switch ($operator) {
                        case 'in':
                        case '!in':
                            $count = count($values);
                            if($count > 0) {
                                for($i = 1; $i<= $count; $i++) {
                                    array_push($bindParams, array(':'.$key.'_'.$i => $values[$i-1]));
                                }
                            }
                            break;
                        case 'between':
                        case '!between':
                            $first = array_key_first($values);
                            $last = array_key_last($values);
                            $first_value = isset($values[$first]) ? $values[$first] : NULL;
                            $last_value = isset($values[$last]) ? $values[$last] : NULL;

                            if($first_value != NULL AND $last_value != NULL) {
                                array_push($bindParams, array(':'.$first => $first_value));
                                array_push($bindParams, array(':'.$last => $last_value));
                            }
                            break;
                        default:
                            array_push($bindParams, array(':'.$key => $values));
                    }
                }

            }

            if(!empty($bindParams)) {
                foreach ($bindParams as $key => $val) {
                    foreach ($val as $k => $v) {
                        $result[$k] = $v;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @param $params
     * @return string
     *
     * Sorgu için WHERE koşullarını oluşturur.
     *
     * Parametreler dizi olarak gönderilir. Dizi elemanlarının değerleri aşağıdaki gibi olmalı.
     *
     * key: Veritabanındaki kolon adı
     * values: dizi veya string/integer/boolen olarak gönderilebilir. BETWEEN operatöründe dizi olmalı.
     * operator: =, !=, <, >, >=, <=, between, !between, in, !in, null, !null, like, !like, startlike, !startlike, endlike, !endlike
     * group_start: Parantez açar (true/false)
     * group_end: Parantez kapatır (true/false)
     * condition: AND veya OR
     * alias: Takma isim
     */
    private function where($params) {

        $where_string = '';

        if($params != NULL) {
            $where_count = 0;
            foreach ($params as $param) {

                $key = isset($param['key']) ? $param['key'] : NULL;

                if($key != NULL) {

                    $values = isset($param['values']) ? $param['values'] : NULL;
                    $condition = isset($param['condition']) ? $param['condition'] : '';
                    $operator = isset($param['operator']) ? $param['operator'] : '=';
                    $alias = isset($param['alias']) ? $param['alias'].'.' : '';

                    if($where_count == 0)
                        $where_string .= ' WHERE ';

                    if(isset($param['group_start']) && $param['group_start'] != false)
                        $where_string .= ' (';

                    switch ($operator) {
                        case '!=':
                        case '<':
                        case '>':
                        case '>=':
                        case '<=':
                            $where_string .= ' '.$alias.$key.' '.$operator.' :'.$key;
                            break;
                        case 'between':
                            $first = array_key_first($values);
                            $last = array_key_last($values);
                            $first_value = isset($values[$first]) ? $values[$first] : NULL;
                            $last_value = isset($values[$last]) ? $values[$last] : NULL;

                            if($first_value != NULL AND $last_value != NULL) {
                                $where_string .= ' '.$alias.$key.' BETWEEN :'.$first.' AND :'.$last;
                            }
                            break;
                        case '!between':
                            $first = array_key_first($values);
                            $last = array_key_last($values);
                            $first_value = isset($values[$first]) ? $values[$first] : NULL;
                            $last_value = isset($values[$last]) ? $values[$last] : NULL;

                            if($first_value != NULL AND $last_value != NULL) {
                                $where_string .= ' '.$alias.$key.' NOT BETWEEN :'.$first.' AND :'.$last;
                            }
                            break;
                        case 'in':
                            $count = count($values);
                            if($count > 0) {
                                $where_string .= '(';
                                for($i = 1; $i<= $count; $i++) {
                                    if($i == 1)
                                        $where_string .= $key .' = :'.$key.'_'.$i;
                                    else
                                        $where_string .= ' OR '.$key .' = :'.$key.'_'.$i;
                                }
                                $where_string .= ')';
                            }
                            break;
                        case '!in':
                            $count = count($values);
                            if($count > 0) {
                                $where_string .= '(';
                                for($i = 1; $i<= $count; $i++) {
                                    if($i == 1)
                                        $where_string .= $key .' != :'.$key.'_'.$i;
                                    else
                                        $where_string .= ' AND '.$key .' != :'.$key.'_'.$i;
                                }
                                $where_string .= ')';
                            }
                            break;
                        case 'null':
                            $where_string .= ' '.$alias.$key.' IS NULL';
                            break;
                        case '!null':
                            $where_string .= ' '.$alias.$key.' IS NOT NULL';
                            break;
                        case 'like':
                            $where_string .= " $alias$key LIKE '%:$key%'" ;
                            break;
                        case '!like':
                            $where_string .= " $alias$key NOT LIKE '%:$key%'" ;
                            break;
                        case 'startlike':
                            $where_string .= " $alias$key LIKE ':$key%'" ;
                            break;
                        case '!startlike':
                            $where_string .= " $alias$key NOT LIKE ':$key%'" ;
                            break;
                        case 'endlike':
                            $where_string .= " $alias$key LIKE '%:$key'" ;
                            break;
                        case '!endlike':
                            $where_string .= " $alias$key NOT LIKE '%:$key'" ;
                            break;
                        default:
                            $where_string .= ' '.$alias.$key.' = :'.$key;
                    }

                    if(isset($param['group_end']) && $param['group_end'] != false)
                        $where_string .= ') ';

                    $where_string .= ' '.$condition.' ';

                    $where_count++;

                }

            }
        }

        return $where_string;
    }

    /**
     * @param $params
     * @return string
     *
     * Parametrelerin örnek gönderimi
     *
     * $params = array(array('table' => 'A','alias' => 'a','type' => 'INNER','condition' => 'a.key = b.key'));
     */
    private function join($params) {

        $string = '';

        if(!empty($params)) {

            foreach ($params as $param) {

                $type = isset($param['type']) ? $param['type'] : 'INNER';
                $table = isset($param['table']) ? $param['table'] : NULL;
                $alias = isset($param['alias']) ? $param['alias'] : NULL;
                $condition = isset($param['condition']) ? $param['condition'] : NULL;

                if($table != NULL && $condition != NULL) {
                    $alias = $alias != NULL ? ' AS '.$alias.' ' : '';
                    $string .= ' '.$type.' JOIN '.$table.$alias.' ON '.$condition;
                }

            }

        }

        return $string;
    }

    /**
     * Bağlantı sonlandırılır.
     */
    public function __destruct()
    {
        $this->db = null;
    }


}
