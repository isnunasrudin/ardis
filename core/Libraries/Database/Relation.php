<?php

namespace Libraries\Database;

use Libraries\Stringable;

trait Relation {

    abstract public function _getTable() : string;

    public function hasMany(string $another_table, $foreign_column = null, $local_column = null)
    {
        $thisTable = Stringable::classToTable(get_called_class());
        $thatTable = Stringable::classToTable($another_table);

        if($foreign_column === null) $foreign_column = $thisTable . "_id";
        if($local_column === null) $local_column = 'id';

        $that = (new $another_table($thatTable))->_where($foreign_column, $this->id);

        return $that;
    }

    public function belongsTo(string $another_table, $foreign_column = null, $local_column = null)
    {
        $thisTable = Stringable::classToTable(get_called_class());
        $thatTable = Stringable::classToTable($another_table);

        if($foreign_column === null) $foreign_column = $thisTable . "_id";
        if($local_column === null) $local_column = 'id';

        $that = (new $another_table($thatTable))->_where($local_column, $this->id);
        $that->operation = "_first";

        return $that;
    }

}