<?php
use Bitrix\Crm\DealTable;
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Защита от прямого вызова
if (!defined("BX_SKIP_AUTH_CHECK")) {
    define("BX_SKIP_AUTH_CHECK", true); // Убери это, если нужна авторизация
}

if (!CModule::IncludeModule("crm")) {
    echo \Bitrix\Main\Web\Json::encode(['error' => 'Модуль CRM не подключен']);
    die();
}

// Получаем список сделок
$deals = DealTable::getList([
    'select' => ['ID', 'TITLE', 'OPPORTUNITY', 'CURRENCY_ID'],
    'limit' => 50,
]);


$result = [];
while ($deal = $deals->Fetch()) {
    $result[] = $deal;
}

echo \Bitrix\Main\Web\Json::encode($result);