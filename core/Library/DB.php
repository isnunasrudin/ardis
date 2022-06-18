<?php

namespace Library;

use mysqli;

abstract class DB {

    private static $conn = null;

    public $db_table = null;
    private $db_where = array();
    private $db_binding = array();

    public static function getConn() : mysqli
    {
        if(self::$conn === null) self::$conn = new mysqli(config('db_host'), config('db_user'), config('db_pass'), config('db_name'));

        return self::$conn;
    }

    // public static function table(string $table) : DB
    // {
    //     $instance = new DB();
    //     $instance->db_table = $table;
    //     return $instance;
    // }

    public function _where($column, $value)
    {
        $this->db_where[$column] = $value;
        return $this;
    }

    private function whereBuilder() : string
    {
        return count($this->db_binding) > 0 ? "WHERE " . implode(",", array_map(function($key, $val){
            $db_binding[] = [$this->getType($val), $val];
            return "$key = ?";
        }, array_keys($this->db_where), array_values($this->db_where))) : '';
    }

    private function getType($val) : string
    {
        if(is_double($val)) return 'd';
        if(is_numeric($val)) return 'i';
        
        return 's';
    }

    public function _get() : object | false
    {
        $stmt = $this->getConn()->prepare("SELECT * FROM $this->table " . $this->whereBuilder());
        for($i=0; $i < count($this->db_binding); $i++)
        {
            $stmt->bind_param($this->db_binding[$i][0], $this->db_binding[$i][1]);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_field();
    }

    public function _count()
    {
        $stmt = $this->getConn()->prepare("SELECT COUNT(*) AS db_count FROM $this->table " . $this->whereBuilder());
        for($i=0; $i < count($this->db_binding); $i++)
        {
            $stmt->bind_param($this->db_binding[$i][0], $this->db_binding[$i][1]);
        }

        $stmt->execute();
        return $stmt->get_result()->fetch_array()['db_count'];
    }

    public static function __callStatic($name, $arguments)
    {
        $that = new DB;
        $that->table = basename(str_replace('\\', '/', get_called_class()));
        return call_user_func_array([$that, "_$name"], $arguments);
    }

    // public static function insert($table, array $data) : int
    // {
    //     $keys   = array_keys($data);
    //     $values = array_values($data);

    //     $stmt   = self::getConn()->conn->prepare("INSERT INTO $table (". implode(",", $keys) .") VALUES (". rtrim(str_repeat("?,", count($values)), ",") .")");
    //     foreach($data as $k => $v)
    //     {
    //         $t = "";
    //         if(is_double($v)) $t = 'd';
    //         elseif(is_numeric($v)) $t = 'i';
    //         else $t = 's';

    //         $stmt->bind_param($t, $data[$k]);
    //     }

    //     $stmt->execute();

    //     return $stmt->affected_rows;
    // }

    // private static function whereBuilder(array $data) : string
    // {

    // }

    // public static function get($table, array $where) : mysqli_result
    // {
        
    // }

}