<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Подключаем файл с таблицей
require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/SamePartner/MyBoolsCatalog/BookTable.php");

use SomePartner\MyBooksCatalog\BookTable;
use Bitrix\Main\Type;

try {
    // Проверка: существует ли таблица
    $dbConnection = \Bitrix\Main\Application::getInstance()->getConnection();
    if (!$dbConnection->isTableExists('my_book')) {
        throw new \Exception("Таблица my_book не существует в БД");
    }
    echo "Таблица существует";

    // Добавление записи
    $result = BookTable::add(array(
      'ISBN' => '978-0321127426',
      'TITLE' => 'Patterns of Enterprise Application Architecture',
      'PUBLISH_DATE' => new Type\Date('2002-11-16', 'Y-m-d')
    ));
    if ($result->isSuccess())
    {
      $id = $result->getId();
    }
    echo 'Добавлено';

    if ($result->isSuccess()) {
        echo "✅ Запись успешно добавлена.<br>";
        echo "Новый ID: " . $result->getId();
    } else {
        echo "❌ Ошибка при добавлении записи:<br>";
        foreach ($result->getErrorMessages() as $error) {
            echo "- " . $error . "<br>";
        }
    }

} catch (\Exception $e) {
    echo "🔥 Исключение: " . $e->getMessage();
}

// Завершение работы с фреймворком
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");