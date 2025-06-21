<?php
$arrData = \Bitrix\Crm\DealTable::getList([
            'select' => ['ID', 'TITLE', 'OPPORTUNITY', 'CURRENCY_ID'],
            'limit' => 50,
        ]);

$arResult['DATA'] = $arrData;


$this->IncludeComponentTemplate();
