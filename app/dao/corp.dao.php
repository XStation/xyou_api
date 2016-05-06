<?php
class dao_corp extends dao
{
    static private $table = 'corp';

	static public function getBy($wp)
    {
        if(empty($wp)){
            return false;
        }

        $w_sql = self::db()->compileWhereSql($wp);
        $sql = 'select * from `'.self::$table."` {$w_sql}";
        return self::db()->getRow($sql);
    }

    static public function insert($sp)
    {
        $s_sql = self::db()->compileSetSql($sp);
        $sql = 'insert into `'.self::$table."` {$s_sql}";
        return self::db()->insert($sql);
    }

    static public function update($sp, $wp)
    {
        $s_sql = self::db()->compileSetSql($sp);
        $w_sql = self::db()->compileWhereSql($wp);
        $sql = 'update `'.self::$table."` {$s_sql} {$w_sql}";
        return self::db()->update($sql);
    }

    static public function replace($sp)
    {
        return self::db()->autoReplace(self::$table, $sp);
    }
    
    static public function updateBy($sp, $wp)
    {
        if(empty($wp)){
            return false;
        }
        return self::update($sp, $wp);
    }

    static public function delete($wp, $limit=0)
    {
        $w_sql = self::db()->compileWhereSql($wp);
        if(!empty($limit)){
            $limit_sql = "limit {$limit}";
        }else{
            $limit_sql = " ";
        }
        $sql = 'delete from `'.self::$table."` {$w_sql} {$limit_sql}";
        return self::db()->delete($sql);
    }
    
    static public function deleteBy($wp, $limit=0)
    {
        if(empty($wp)){
            return false;
        }
        return self::delete($wp, $limit);
    }

    static public function listAll()
    {
        $sql = 'select * from `'.self::$table."` ";
        return self::db()->getAll($sql);
    }

    static public function listBy($wp=Array(), $limit_sql='', $start='', $limit='', $order_by='', $sort_by='')
    {
        $w_sql = self::db()->compileWhereSql($wp);
        if(empty($limit_sql)){
            if(!empty($limit)){
                $start = intval($start);
                $limit = intval($limit);
                $limit_sql = "limit {$start}, {$limit}";
            }
        }
        if(empty($order_by)){
            $order_by = Null;
        }
        if($order_by === null){
            $order_sql = " order by null desc";
        }else{
            if(empty($sort_by)){
                $order_sql = " order by `{$order_by}` desc";
            }else{
                $order_sql = " order by `{$order_by}` asc";
            }
        }
        
        $sql = 'select * from `'.self::$table."` {$w_sql} {$order_sql} {$limit_sql}";
        return self::db()->getAll($sql);
    }

    static public function countBy($wp=Array(), $limit_sql='', $start='', $limit='', $order_by='', $sort_by='')
    {
        $w_sql = self::db()->compileWhereSql($wp);
        if(empty($limit_sql)){
            if(!empty($limit)){
                $start = intval($start);
                $limit = intval($limit);
                $limit_sql = "limit {$start}, {$limit}";
            }
        }
        $sql = 'select count(1) from `'.self::$table."` {$w_sql} ";
        return self::db()->getOne($sql);
    }

    static public function getOne($sql)
    {
        return self::db()->getOne($sql);
    }


    static public function getRow($sql)
    {
        return self::db()->getRow($sql);
    }

    static public function getAll($sql)
    {
        return self::db()->getAll($sql);
    }



}
