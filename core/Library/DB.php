<?php

namespace Library;

use mysqli;
use Models;

class DB {

    private static $conn = null;

    public $table = null;
    private $db_where = array();
    private $db_binding = array();

    public function __construct($table = null)
    {
        $this->table = Stringable::to_snake_case($table);
    }

    public static function _getConn() : mysqli
    {
        if(self::$conn === null) self::$conn = new mysqli(config('db_host'), config('db_user'), config('db_pass'), config('db_name'));

        return self::$conn;
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

    public function _get() : object | false
    {
        $stmt = $this->_getConn()->prepare("SELECT * FROM $this->table " . $this->_whereBuilder());
        for($i=0; $i < count($this->db_binding); $i++)
        {
            $stmt->bind_param($this->db_binding[$i][0], $this->db_binding[$i][1]);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_field();
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
        return $this->_get()[0];
    }

    public static function __callStatic($name, $arguments)
    {
        $that = get_called_class();
        $that = new $that($that);
        
        foreach(array_diff(get_class_methods($that), get_class_methods(new DB())) as $method){
            $that->{$method} = call_user_func([$that, $method]);  
        }

        return call_user_func_array([$that, "_$name"], $arguments);
    }

    // RELATION

    public function hasMany($another_table, $relation_key = null, $local_key = null)
    {
        return $this->_get();
    }

    public function belongsTo($another_table, $relation_key = null, $local_key = null)
    {
        return $this->_get();
    }

}