<?php

namespace App\classes\MVC;

require_once __DIR__ . '/../../../../vendor/j4mie/idiorm/idiorm.php';

use ORM;

abstract class Model
{
    protected static $tableName;

    private static function prepareSting(string &$str): bool
    {
        $str = trim($str);

        $allowedTags = [
            ['<b>', '</b>'],
            ['<i>', '</i>'],
            ['<p>', '</p>'],
            ['<strong>', '</strong>'],
            ['<small>', '</small>']
        ];

        foreach ($allowedTags as $allowedTag) {
            $str = str_replace(
                $allowedTag[0],
                str_replace(
                    ['<', '>'],
                    [
                        '##OPEN_BRACKET##',
                        '##CLOSE_BRACKET##'
                    ],
                    $allowedTag[0]
                ),
                $str
            );

            $str = str_replace(
                $allowedTag[1],
                str_replace(
                    ['<', '>'],
                    [
                        '##OPEN_BRACKET##',
                        '##CLOSE_BRACKET##'
                    ],
                    $allowedTag[1]
                ),
                $str
            );
        }

        $str = htmlspecialchars($str);

        foreach ($allowedTags as $allowedTag) {
            $str = str_replace(
                str_replace(
                    ['<', '>'],
                    ['##OPEN_BRACKET##', '##CLOSE_BRACKET##'],
                    $allowedTag[0]
                ),
                $allowedTag[0],
                $str
            );

            $str = str_replace(
                str_replace(
                    ['<', '>'],
                    ['##OPEN_BRACKET##', '##CLOSE_BRACKET##'],
                    $allowedTag[1]
                ),
                $allowedTag[1],
                $str
            );
        }

        return $str !== '';
    }

    public static function all(): array
    {
        return ORM::forTable(static::$tableName)->findArray();
    }

    public static function find(int $id): ORM
    {
        return ORM::forTable(static::$tableName)->findOne($id);
    }

    public static function create(array $modelData): ORM
    {
        $preparedInsertData = [];

        foreach ($modelData as $key => $value) {
            if (is_string($value) && self::prepareSting($value)) {
                $preparedInsertData[$key] = $value;
                continue;
            } else {
                $preparedInsertData[$key] = $value;
            }
        }

        $result = ORM::forTable(static::$tableName)->create($preparedInsertData);
        $result->save();

        return $result;
    }

    public static function delete(int $id): void
    {
        ORM::forTable(static::$tableName)->find_one($_POST['id'])->delete();
    }
}