<?php

class DriveORM {

    public static function getDrive(&$classConn) {
        switch ($classConn->type) {
            case 'mysql':
                return new MySqlDrive($classConn);
            case 'sqlite':
                return new SqliteDrive($classConn);
            case 'pgsql':
                return new PgSqlDrive($classConn);
            default:
                return false;
        }
    }

}