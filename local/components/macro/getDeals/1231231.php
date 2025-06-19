<?php
#components/bitrix/example/ajax.php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// class ExampleAjaxController extends \Bitrix\Main\Engine\Controller
// {
// 	#в параметр $person будут автоматически подставлены данные из REQUEST
// 	public function sayByeAction($person = 'guest')
// 	{
// 		return "Goodbye {$person}";
// 	}
// 	public function listDealsAction()
// 	{
//     $deals = Bitrix\Crm\DealTable::getList([
//       'select' => ['ID', 'TITLE', 'OPPORTUNITY', 'CURRENCY_ID'],
//       'limit' => 50,
//     ]);

//     $result = [];
//     while ($deal = $deals->Fetch()) {
//         $result[] = $deal;
//     }
//     return $result;
// 	}
// }


// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 


// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");