<?php
use Bitrix\Crm\DealTable;
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Скипаем авторизацию
if (!defined("BX_SKIP_AUTH_CHECK")) {
    define("BX_SKIP_AUTH_CHECK", true);
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