<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 
$APPLICATION->SetTitle('Example');
?>

<?

use Services\Vue;
use Local\Components\Macro\GetDeals;
// Подключаем vue компонент


Vue::file('components/macro/getDeals/js/GetDeals.vue');
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>