<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Разобраться с подключением классов!!!
// Подключаем файл с таблицей
require_once($_SERVER["DOCUMENT_ROOT"] . "/local/modules/somepartner.mybookscatalog/lib/book.php");

use SomePartner\MyBooksCatalog\BookTable;
use Bitrix\Main\Type;


function add() {
    try {
        // Проверка: существует ли таблица
        $dbConnection = \Bitrix\Main\Application::getInstance()->getConnection();
        if (!$dbConnection->isTableExists('my_book')) {
            throw new \Exception("Таблица my_book не существует в БД");
        }
        echo "Таблица существует" . '<br>';

        // Добавление записи
        $result = BookTable::add(array(
        'ISBN' => '978-0321127426',
        'TITLE' => 'Patterns of Enterprise Application Architecture',
        'PUBLISH_DATE' => new Type\Date('2002-11-16', 'Y-m-d'),
        'EDITIONS_ISBN' => ['9780321127422', '9780321127421']
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
}


function update($id) {
    try {
        // Изменение записи
        $result = BookTable::update($id, array(
            'PUBLISH_DATE' => new Type\Date('2102-11-15', 'Y-m-d')
        ));
        if ($result->isSuccess())
        {
            echo '✅ Запись обновлена, количество обновленных строк: ' . $result->getAffectedRowsCount();
        } else {
            echo "❌ Ошибка при добавлении записи:<br>";
            foreach ($result->getErrorMessages() as $error) {
                echo "- " . $error . "<br>";
            }
            throw new \Exception("❌ Запись не изменена");
        }

    } catch (\Exception $e) {
        echo "🔥 Исключение: " . $e->getMessage();
    }
}

echo "Тестовая страница <br>";

add();

// update(2);

// Завершение работы с фреймворком
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");


// CREATE TABLE IF NOT EXISTS `my_book` (
//     `ID` int NOT NULL AUTO_INCREMENT,
//      `ISBNCODE` varchar(255) NOT NULL,
//      `TITLE` varchar(255) NOT NULL,
//      `PUBLISH_DATE` date NOT NULL, 
//      `EDITIONS_ISBN` text NOT NULL, 
//      `READERS_COUNT` int NOT NULL, 
//      PRIMARY KEY(`ID`))
