<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 


use Services\Vue;
// Подключаем vue компонент
Vue::file('components/macro/getDeals/js/GetDeals.vue');
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>