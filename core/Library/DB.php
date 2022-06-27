<?php

namespace Libraries;

use Exception;
use mysqli;

class DB {

    use Relation;

    private static $conn = null;

    public $table = null;
    private $db_where = array();
    private $db_binding = array();

    public function __construct(string $class = "")
    {
        $this->table = Stringable::classToTable($class);
    }

    public function _getTable(): string
    {
        return $this->table;
    }

    public static function _getConn() : mysqli
    {
        if(self::$conn === null) self::$conn = new mysqli(config('db_host'), config('db_user'), config('db_pass'), config('db_name'));

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

    public function _where($column, $value)
    {
        $this->db_where[$column] = $value;
        return $this;
    }

    private function _whereBuilder() : string
    {
        return count($this->db_binding) > 0 ? "WHERE " . implode(",", array_map(function($key, $val){
            $db_binding[] = [$this->_($val), $val];
            return "$key = ?";
        }, array_keys($this->db_where), array_values($this->db_where))) : '';
    }

    private function _($val) : string
    {
        if(is_double($val)) return 'd';
        if(is_numeric($val)) return 'i';
        
        return 's';
    }

    public function _get()
    {
        $stmt = $this->_getConn()->prepare("SELECT * FROM $this->table " . $this->_whereBuilder());
        for($i=0; $i < count($this->db_binding); $i++)
        {
            $stmt->bind_param($this->db_binding[$i][0], $this->db_binding[$i][1]);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return Collection::mysqlresultToObject($result, get_called_class());
    }

    public function _count()
    {
        $stmt = $this->_getConn()->prepare("SELECT COUNT(*) AS db_count FROM $this->table " . $this->_whereBuilder());
        for($i=0; $i < count($this->db_binding); $i++)
        {
            $stmt->bind_param($this->db_binding[$i][0], $this->db_binding[$i][1]);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_array()['db_count'];
    }

    public function _find($id)
    {
        return $this->_where('id', $id)->_first();
    }

    public function _first()
    {
        $stmt = $this->_getConn()->prepare("SELECT * FROM $this->table " . $this->_whereBuilder());
        for($i=0; $i < count($this->db_binding); $i++)
        {
            $stmt->bind_param($this->db_binding[$i][0], $this->db_binding[$i][1]);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_object(get_called_class());
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

        throw new Exception("Atribut tidak ditemukan");
    }

}