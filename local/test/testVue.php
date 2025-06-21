<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 

$APPLICATION->IncludeComponent(
  'macro.vue.test:getDeals',
  'list'
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
