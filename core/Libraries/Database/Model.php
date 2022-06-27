<?php

namespace Libraries\Database;

class Model extends DB
{
    use Relation;

    public $uuidPrimaryKey = false;

    public $primaryKey = 'id';

    public $timestamps = true;
    
}