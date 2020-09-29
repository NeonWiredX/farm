<?php


namespace Farm\Enum;


class ObjectStatusEnum
{

    protected static int $default = self::STATUS_OLD;

    public const STATUS_NEW = 10;
    public const STATUS_OLD = 20;

    public static function getNames(): array
    {
        return [
            static::STATUS_NEW => 'Новый',
            static::STATUS_OLD => 'Старый'
        ];
    }

    public static function getName($key){
        if (!array_key_exists($key,static::getNames())){
            return static::getNames()[static::$default];
        }
        return static::getNames()[$key];
    }

}