<?php

namespace App\Traits;

class SqlHelper
{
    public static function andLike($data, $column, $sql, $extraCondition = true)
    {
        $returnData = '';
        if (!empty($data) && $extraCondition)
        {
            $returnData = $column . ' LIKE \'%' . $data . '%\' ';
            $returnData = !empty($sql) ? ' AND ' . $returnData : $returnData;
        } else
            $returnData = '';

        return $returnData;
    }

    public static function andEqual($data, $column, $sql, $extraCondition = true)
    {
        $returnData = '';
        if (!empty($data) && $extraCondition)
        {
            $returnData = $column . '=\'' . $data . '\' ';
            $returnData = !empty($sql) ? ' AND ' . $returnData : $returnData;
        } else
            $returnData = '';

        return $returnData;
    }

    public static function andNotEqualEmpty($data, $column, $sql, $extraCondition = true)
    {
        $returnData = '';
        if (!empty($data) && $extraCondition)
        {
            $returnData = $column . ' <> \'\'';
            $returnData = !empty($sql) ? ' AND ' . $returnData : $returnData;
        } else
            $returnData = '';

        return $returnData;
    }

    public static function between($data1, $data2, $column, $sql, $extraCondition = true)
    {
        $returnData = '';
        $data1 = strip_tags($data1);
        $data2 = strip_tags($data2);
        if (!empty($data1) && empty($data2) && $extraCondition)
        {
            $returnData = $column . ' >= \'' . $data1 . '\' ';
            $returnData = !empty($sql) ? ' AND ' . $returnData : $returnData;
        } else if (empty($data1) && !empty($data2) && $extraCondition)
        {
            $returnData = $column . ' <= \'' . $data2 . '\' ';
            $returnData = !empty($sql) ? ' AND ' . $returnData : $returnData;
        } else if (!empty($data1) && !empty($data2) && $extraCondition)
        {
            $returnData = $column . ' BETWEEN  \''.$data1.'\' AND \''.$data2.'\' ';
            $returnData = !empty($sql) ? ' AND ' . $returnData : $returnData;
        }
        if (empty($data1) && empty($data2))
            $returnData = '';

        return $returnData;
    }

    public static function betweenDate($data1, $data2, $column, $sql, $extraCondition1 = true, $extraCondition2 = true)
    {
        $returnData = '';
        $data1 = strip_tags($data1);
        $data2 = strip_tags($data2);
        if (!empty($data1) && empty($data2) && $extraCondition1)
        {
            $returnData = 'CAST('.$column.' AS DATE)' . ' >= \'' . date('Y-m-d', strtotime($data1)) . '\' ';
            $returnData = !empty($sql) ? ' AND ' . $returnData : $returnData;
        } else if (empty($data1) && !empty($data2) && $extraCondition2)
        {
            $returnData = 'CAST('.$column.' AS DATE)' . ' <= \'' . date('Y-m-d', strtotime($data2)) . '\' ';
            $returnData = !empty($sql) ? ' AND ' . $returnData : $returnData;
        } else if (!empty($data1) && !empty($data2) && $extraCondition1 && $extraCondition2)
        {

            $returnData = $column . ' BETWEEN  \''. date('Y-m-d', strtotime($data1)) .'\' AND \'' . date('Y-m-d', strtotime($data2)) . '\' ';
            $returnData = !empty($sql) ? ' AND ' . $returnData : $returnData;
        }
        if (empty($data1) && empty($data2))
            $returnData = '';

        return $returnData;
    }

    public static function customSwitch($data, $conditions, $sql)
    {
        $returnedData = '';
        $data = strip_tags($data);
        foreach ($conditions as $key => $item)
            if ($data == $key)
                $returnedData = $item;
        if (!empty($returnedData))
            $returnedData = !empty($sql) ? (' AND ' . $returnedData) : ($returnedData . ' ');
        return $returnedData;
    }
}