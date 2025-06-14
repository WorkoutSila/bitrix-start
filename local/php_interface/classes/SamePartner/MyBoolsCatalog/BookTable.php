<?php
// 
namespace SomePartner\MyBooksCatalog;

use Bitrix\Main\Entity;

class BookTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'my_book';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new Entity\StringField('ISBN', [
                'required' => true,
                'column_name' => 'ISBNCODE',
            ]),
            new Entity\StringField('TITLE'),
            new Entity\DateField('PUBLISH_DATE'),
        ];
    }
}