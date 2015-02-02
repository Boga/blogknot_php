<?php

class PGTimestamp
{
    public static function php2pg($php_timestamp)
    {
        return date('Y-m-d G:i:s', $php_timestamp);
    }

    public static function pg2php($pg_timestamp)
    {
        return strftime('Y-m-d G:i:s', $pg_timestamp);
    }

}