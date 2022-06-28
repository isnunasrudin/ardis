<?php

namespace Libraries\Database;

abstract class Migration
{
    private $column = array();
    private $attrib = array();

    private $indexs = array();

    // FUNGSI KEBUTUHAN
    private function _lastKey() : int
    {
        return count($this->column) - 1;
    }

    private function _lastColumn()
    {
        return explode(" ", $this->column[$this->_lastKey()])[0];
    }

    public function execute($table)
    {
        call_user_func([$this, 'run']);
        $sql = "CREATE TABLE IF NOT EXISTS $table (" . implode(",", array_merge($this->column, $this->attrib)) . ");";
        DB::_getConn()->query($sql);
        if(count($this->indexs) > 0){
            $sql = "";
            foreach($this->indexs as $index) {
                $sql .= "CREATE INDEX index_". implode('_', $index) ." ON $table(". implode(',', $index) . ");";
            }
            DB::_getConn()->query($sql);
        }
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

    public function text($column)
    {
        $this->column[] = "$column text NOT NULL";
        return $this;
    }

    public function timestamp($column)
    {
        $this->column[] = "$column timestamp NOT NULL";
        return $this;
    }

    // ATRIBUT LAIN

    public function nullable()
    {
        $this->column[$this->_lastKey()] = str_replace(" NOT NULL", " NULL", $this->column[$this->_lastKey()]);
        return $this;
    }

    public function unique()
    {
        $this->column[$this->_lastKey()] .= " UNIQUE";
        return $this;
    }

    public function autoIncrement()
    {
        $this->column[$this->_lastKey()] .= " AUTO_INCREMENT";
        return $this;
    }

    // KUNCI

    public function primary()
    {
        $this->attrib[] = "PRIMARY KEY (". $this->_lastColumn() .")";
        return $this;
    }

    public function foreign($another_table, $column = 'id')
    {
        $this->attrib[] = "FOREIGN KEY (". $this->_lastColumn() .") REFERENCES $another_table($column)";
        return $this;
    }

    // KHUSUS

    public function index($columns = array())
    {
        $this->indexs[] = count($columns) > 0 ? $columns : [$this->_lastColumn()];
        return $this;
    }

    // CUSTOM COLUMN

    public function timestamps($withDeletedAt = false)
    {
        $this->timestamp('created_at')->nullable();
        $this->timestamp('updated_at')->nullable();
        
        if( $withDeletedAt ) $this->timestamp('deleted_at')->nullable();
    }
}