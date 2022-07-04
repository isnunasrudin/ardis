<?php

namespace Libraries\Database;

use Exception;
use mysqli;
use Libraries\Stringable;
use Libraries\Collection;
use mysqli_result;

class DB {

    private static $conn = null;

    public $table = null;
    private $db_where = array();
    private $db_binding = array();
    private $db_select = array('*');

    public function __construct(string $class = "")
    {
        $this->table = Stringable::classToTable($class);
    }

    public function _getTable(): string
    {
        return $this->table;
    }

    public function _table($table)
    {
        $this->table = $table;
        return $this;
    }

    public static function _getConn() : mysqli
    {
        if(self::$conn === null) self::$conn = new mysqli(config('db_host'), config('db_user'), config('db_password'), config('db_name'));

        return self::$conn;
    }

    public static function begin() : void
    {
        self::_getConn()->begin_transaction();
    }

    public static function commit() : void
    {
        self::_getConn()->commit();
    }

    public static function rollback() : void
    {
        self::_getConn()->rollback();
    }

    public static function customQuery($sql) : mysqli_result|bool|null
    {
        return self::getConn()->query($sql);
    }

    public function _where($column, $value)
    {
        $this->db_where[$column] = $value;
        return $this;
    }

    private function _whereBuilder() : string
    {
        return count($this->db_where) > 0 ? "WHERE " . implode(" AND ", array_map(function($key, $val){
            $this->db_binding[] = $val;
            return "$key = ?";
        }, array_keys($this->db_where), array_values($this->db_where))) : '';
    }

    private function _selectBuilder() : string
    {
        return implode("*", $this->db_select);
    }

    public function _insert(array $data)
    {
        if(isset($this->uuidPrimaryKey) && $this->uuidPrimaryKey)
        {
            $data = array_merge($data, [$this->primaryKey => Stringable::uuid()]);
        }

        $now = date('Y-m-d H:i:s');

        if(isset($this->timestamps) && $this->timestamps)
        {
            $data = array_merge($data, [
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }

        $columns = implode(',', array_keys($data));

        $values = array_values($data);
        $values_ = substr(str_repeat('?,', count($values)), 0, -1);

        $sql = ("INSERT INTO $this->table ($columns) VALUES ($values_)");

        $stmt = $this->_getConn()->prepare($sql);

        $stmt->execute($values);

        return $this->_find($this->_getConn()->insert_id);
    }

    public function _find($id)
    {
        return $this->_where('id', $id)->_first();
    }

    public static function __callStatic($name, $arguments)
    {
        $that = get_called_class();
        $that = new $that($that);

        return call_user_func_array([$that, "_$name"], $arguments);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this, "_$name"], $arguments);
    }

    public function __get($name)
    {
        if(method_exists($this, $name))
        {
            $result = call_user_func([$this, $name]);

            if($result instanceof DB)
            {
                $operation = $result->operation ?? '_get';
                return $result->$operation();
            }

            return $result;
        }

        throw new Exception("Atribut $name tidak ditemukan");
    }

    // == UPDATE ==

    private function _updateBuilder(array $data)
    {
        return 'SET ' . implode(', ', array_map(function($k, $v){
            $this->db_binding[] = $v;
            return "$k = ?";
        }, array_keys($data), array_values($data)));
    }


    public function _update(array $data)
    {
        $this->_where($this->primaryKey, $this->{$this->primaryKey});
        $sql = "UPDATE $this->table " . $this->_updateBuilder($data) . ' ' . $this->_whereBuilder();
        $stmt = $this->_getConn()->prepare($sql);
        $stmt->execute($this->db_binding);
    }

    // == DELETE ==
    public function _delete()
    {
        $this->_where($this->primaryKey, $this->{$this->primaryKey});
        $sql = "DELETE FROM $this->table " . $this->_whereBuilder();
        $stmt = $this->_getConn()->prepare($sql);
        $stmt->execute($this->db_binding);
    }

    // == GETTER ==

    public function _get()
    {
        $stmt = $this->_getConn()->prepare("SELECT " . $this->_selectBuilder() . " FROM $this->table " . $this->_whereBuilder());
        $stmt->execute($this->db_binding);
        $result = $stmt->get_result();

        return Collection::mysqlresultToObject($result, get_called_class(), $this->table);
    }

    public function _first()
    {
        $stmt = $this->_getConn()->prepare("SELECT " . $this->_selectBuilder() . " FROM $this->table " . $this->_whereBuilder() . " LIMIT 1");
        $stmt->execute($this->db_binding);

        $result = $stmt->get_result()->fetch_object(get_called_class());
        if(!is_null($result)) $result->table = $this->table; 
        return $result;
    }

    public function _count()
    {
        $stmt = $this->_getConn()->prepare("SELECT COUNT(*) AS db_count FROM $this->table " . $this->_whereBuilder());
        $stmt->execute($this->db_binding);
        return $stmt->get_result()->fetch_array()['db_count'];
    }

}