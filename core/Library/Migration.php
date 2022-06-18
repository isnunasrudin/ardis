<?php

namespace Library;

abstract class Migration
{
    public $column = array();
    public $attrib = array();

    // FUNGSI KEBUTUHAN
    private function _lastKey() : int
    {
        return count($this->column) - 1;
    }

    private function _lastColumn()
    {
        return explode(" ", $this->column[$this->_lastKey()])[0];
    }

    // TIPE DATA

    public function string($column, $length = 255)
    {
        $this->column[] = "$column varchar($length) NOT NULL";
        return $this;
    }

    public function integer($column, $length = 10)
    {
        $this->column[] = "$column int($length) NOT NULL";
        return $this;
    }

    // ATRIBUT LAIN

    public function nullable()
    {
        $this->column[$this->_lastKey()] = str_replace(" NOT NULL", "", $this->column[$this->_lastKey()]);
        return $this;
    }

    // KUNCI

    public function primary()
    {
        $this->attrib[] = "PRIMARY KEY (". $this->_lastColumn() .")";
        return $this;
    }

    public function foreign($table, $column)
    {
        $this->attrib[] = "FOREIGN KEY (". $this->_lastColumn() .") REFERENCES $table($column)";
        return $this;
    }

    public function execute()
    {
        call_user_func([$this, 'run']);
        $table = strtolower(basename(str_replace("\\", "/", get_class($this))));
        $sql = "CREATE TABLE IF NOT EXISTS $table (" . implode(",", array_merge($this->column, $this->attrib)) . ");";
        DB::getConn()->query($sql);
    }
}