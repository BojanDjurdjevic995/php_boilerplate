<?php
namespace App\Models;

class Model extends DB
{
    protected static $order, $get, $where, $bigWhere, $join, $count, $tableJoin, $selectExternal, $select,
                     $gropuBy, $limit, $offset, $Leftjoin, $rightJoin, $first = false, $toArray = false, $toJSON = false;

    /**
     * This method return array of item from database
     * @return mixed
     */
    public static function get($toSql = false)
    {
        $class = get_called_class();
        $table = $class::$table;

        self::$get =  (empty(self::$count))      ? (isset(self::$select) ? self::$select : "SELECT $table.* ") : self::$count;
        self::$get .= (!empty(self::$tableJoin)) ? self::$selectExternal : "";
        self::$get .= ' FROM ' . $table . ' ';
        if (empty(self::$where) && !empty(self::$bigWhere))
            self::$bigWhere = ' WHERE ' . self::$bigWhere;

        if (!empty(self::$where) && !empty(self::$bigWhere))
            self::$bigWhere = ' AND ' . self::$bigWhere;
        if (!empty(self::$limit) && empty(self::$offset))
            self::offset();
        if (empty(self::$limit) && !empty(self::$offset))
            self::limit();
        $conn       = self::connect();
        $getData    = $conn->prepare(self::$get . self::$Leftjoin . self::$rightJoin . self::$join . self::$where . self::$bigWhere . self::$gropuBy . self::$order .self::$limit . self::$offset);
        if ($toSql)
            return $getData->queryString;
        $getData->execute();
        self::$where            = NULL;
        self::$order            = '';
        self::$bigWhere         = '';
        self::$join             = '';
        self::$Leftjoin         = '';
        self::$rightJoin        = '';
        self::$count            = '';
        self::$selectExternal   = '';
        self::$gropuBy          = '';
        self::$select           = NULL;
        self::$tableJoin        = '';
        self::$limit            = '';
        self::$offset           = '';
        $obj = self::$toArray ? \PDO::FETCH_ASSOC : \PDO::FETCH_OBJ;
        self::$toArray = false;
        if (self::$first) {
            self::$first  = false;
            if (self::$toJSON)
                return json_encode($getData->fetch($obj));
            return $getData->fetch($obj);
        }
        if (self::$toJSON)
            return json_encode($getData->fetchAll($obj));
        return $getData->fetchAll($obj);
    }

    /**
     * This method return first of item from database
     * @return mixed
     */
    public static function first($toSql = false)
    {
        self::$first  = true;
        self::limit(0);
        self::offset(1);
        return self::get($toSql);
    }

    /**
     * This method execute sql query and return array of item from database
     * @param sql
     * @return mixed

     */
    public static function sql($sql)
    {
        $conn = self::connect();
        $getData = $conn->prepare($sql);
        $getData->execute();
        return $getData->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * This method order records by column and type
     * @param string $column
     * @param string $type
     * @return class
     */
    public static function orderBy($column = 'created_at', $type = 'DESC')
    {
        $class = get_called_class();
        $table = $class::$table;
        self::$order = ' ORDER BY ' . $column . ' ' . $type . ' ';
        return (new static);
    }

    /**
     * This method adds condition by column and value
     * @param $column
     * @param $value
     * @return class
     */
    public static function where($column, $condition, $value = null)
    {
        $parameters = ['>', '<', '=', '<=', '>=', '<>', 'BETWEEN', 'LIKE', 'IN', 'NOT LIKE'];
        if(in_array(strtoupper($condition), $parameters) && $condition != "0")
        {
            if (empty(self::$where))
                self::$where .= ' WHERE ' . $column . ' ' . $condition . ' "' . ($condition == 'LIKE' ? '%' : '');
            else
                self::$where .= ' AND ' . $column . ' ' . $condition . ' "' . ($condition == 'LIKE' ? '%' : '');

            if (strtoupper($condition) == 'BETWEEN')
                self::$where .= $value[0] . '" AND ' . '"' . $value[1] . '" ';
            else
                self::$where .= $value . ($condition == 'LIKE' ? '%' : '') .'" ';

        } else {
            if (empty(self::$where))
                self::$where .= ' WHERE ' . $column . '="' . $condition . '" ';
            else
                self::$where .= ' AND ' . $column . '="' . $condition . '" ';
        }

        $class = get_called_class();
        return (new static);
    }

    public static function whereColumns($column, $condition, $value = null)
    {
        $parameters = ['>', '<', '=', '<=', '>=', '<>', 'BETWEEN', 'LIKE', 'IN', 'NOT LIKE'];
        if(in_array(strtoupper($condition), $parameters) && $condition != "0")
        {
            if (empty(self::$where))
                self::$where .= ' WHERE ' . $column . ' ' . $condition . ' ';
            else
                self::$where .= ' AND ' . $column . ' ' . $condition . ' ';

            self::$where .= $value . ' ';

        } else {
            if (empty(self::$where))
                self::$where .= ' WHERE ' . $column . '=' . $condition . ' ';
            else
                self::$where .= ' AND ' . $column . '=' . $condition . ' ';
        }

        $class = get_called_class();
        return (new static);
    }

    /**
     * This method adds condition by column id
     * @param $id
     * @return mixed
     */
    public static function whereId($id)
    {
        if (empty(self::$where))
            self::$where .= ' WHERE id="' . $id . '" ';
        else
            self::$where .= ' AND id="' . $id . '" ';

        $class = get_called_class();
        return (new static);
    }

    /**
     * This method is for large sql query
     * @param $sql
     * @return mixed
     */
    public static function bigWhere($sql)
    {
        $class = get_called_class();
        self::$bigWhere = $sql;
        return (new static);
    }

    /**
     * This method join other table
     * @param $table
     * @param $primaryKey
     * @param $foreignKey
     * @return mixed
     */
    public static function join($table, $primaryKey, $foreignKey)
    {
        self::$tableJoin = $table;
        $class = get_called_class();
        self::$join .= ' JOIN ' . $table . ' ON ' . $primaryKey . '=' . $foreignKey;
        return (new static);
    }

    /**
     * This method join other table
     * @param $table
     * @param $primaryKey
     * @param $foreignKey
     * @return mixed
     */
    public static function leftJoin($table, $primaryKey, $foreignKey)
    {
        self::$tableJoin = $table;
        $class = get_called_class();
        self::$Leftjoin .= ' LEFT JOIN ' . $table . ' ON ' . $primaryKey . '=' . $foreignKey . ' ';
        return (new static);
    }

    /**
     * This method join other table
     * @param $table
     * @param $primaryKey
     * @param $foreignKey
     * @return mixed
     */
    public static function rightJoin($table, $primaryKey, $foreignKey)
    {
        self::$tableJoin = $table;
        self::$rightJoin .= ' RIGHT JOIN ' . $table . ' ON ' . $primaryKey . '=' . $foreignKey . ' ';
        return (new static);
    }

    /**
     * This method count records in table
     * @param $title
     * @return mixed
     */
    public static function count($title)
    {
        $class = get_called_class();
        self::$count = 'SELECT count(*) as ' . $title . ' ';
        return (new static);
    }

    /**
     * This method selects other columns we want and we can use if have join on other table
     * @param $select
     * @return mixed
     */
    public static function selectExternal($select)
    {
        $class = get_called_class();
        self::$selectExternal = ' , ' . $select . ' ';
        return (new static);
    } 

    /**
     * This method selected specific item from the database
     * @param null $select
     * @return mixed
     */
    public static function select($select = null)
    {
        $class = get_called_class();
        $table = $class::$table;
        self::$select = !empty($select) ? ('SELECT ' . $select) : ('SELECT '.$table.'.* ');
        return (new static);
    }

    /**
     * This method groups the items in the database
     * @param $by
     * @return mixed
     */
    public static function groupBy($by)
    {
        $class = get_called_class();
        self::$gropuBy = ' GROUP BY ' . $by . ' ';
        return (new static);
    }

    /**
     * This method defines how many objects are skipped from the database
     * @param $limit
     * @return mixed
     */
    public static function limit($limit = 0)
    {
        $class = get_called_class();
        self::$limit = ' LIMIT ' . $limit . ', ';
        return (new static);
    }

    /**
     * This method define how items get from database
     * @param $offset
     * @return mixed
     */
    public static function offset($offset = 15)
    {
        $class = get_called_class();
        self::$offset = $offset;
        return (new static);
    }

    /**
     * This method return datas into array
     * @return mixed
     */
    public static function toArray()
    {
        self::$toArray = true;
        return (new static);
    }

    /**
     * This method return datas into json
     * @return mixed
     */
    public static function toJSON()
    {
        self::$toJSON = true;
        return (new static);
    }

    /**
     * This method return data by id
     * @return mixed
     */
    public static function find($id)
    {
        $class = get_called_class();
        self::whereId($id);
        $data = self::first();
        $class = new $class();
        $keys = array_keys((array)$data);
        $values = array_values((array)$data);

        for ($i = 0; $i < count($keys); $i++)
            $class->{$keys[$i]} = $values[$i];
        return $class;
    }

    /**
     * Insert new record to database
     * @param array $columns [Names of columns in database]
     * @param array $value [values for columns in database]
     * @return bool [if inserts successfully new records the method returns true, if not returns false]
     */
    public static function insert($columns = array(), $value = array())
    {
        if (count($columns) == count($value))
        {
            $conn = self::connect();
            $class = get_called_class();
            $table = $class::$table;
            $sql = "INSERT INTO $table (";
            foreach($columns as $key => $c)
                $sql .= $c . ( ++$key != count($columns) ? ', ' : ') ' );

            $sql .= 'VALUES (';
            foreach($value as $key => $v)
                $sql .= (++$key != count($value)) ? '?, ' : '?)';

            $stmt = $conn->prepare($sql);
            if ($stmt->execute($value)) {
                self::offset(1);
                self::select('id');
                self::orderBy('id');
                return self::first()->id;
            } return false;
        } else
            return false;
    }

    /**
     * Update record in database
     * @param array $columns [Names of columns in database]
     * @param array $value [values for columns in database]
     * @param array $array [this parameter is an array whose first member is a column and the second is a value. If we enter them we will only update the data for that row(s), if we do not pass this parameter we will update all the rows in the table]
     * @return bool
     */
    public static function update($columns = array(), $value = array(), $array = array(), $condition = false)
    {
        $conn = self::connect();
        $class = get_called_class();
        $table = $class::$table;
        $sql = "UPDATE $table SET ";
        foreach ($columns as $key => $c)
        {
            $comma = ++$key == count($columns) ? ' ' : ', ';
            $sql .= $c . '=?' . $comma;
        }
        if(!empty($array))
        {
            $sql .= 'WHERE ' . $array[0] . '=?';
            $value[] = $array[1];
        }
        if ($condition)
            $sql .= ' AND ' . $condition;

        $stmt = $conn->prepare($sql);

        return $stmt->execute($value) ? true : false;
    }

    /**
     * This method destroy record from database
     * @param array $array
     * @return bool
     */
    public static function destroy($array = array(), $condition = false)
    {
        $conn = self::connect();
        $class = get_called_class();
        $table = $class::$table;
        $sql = "DELETE FROM $table WHERE $array[0]=?";
        if ($condition)
            $sql .= ' AND '.$condition;

        $stmt = $conn->prepare($sql);
        return $stmt->execute([$array[1]]) ? true : false;
    }
}