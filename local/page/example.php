<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
\Bitrix\Main\UI\Extension::load("vue");
\Bitrix\Main\UI\Extension::load("local.taskmanager");
?>
<div id="application"></div>
<script type="text/javascript">
	console.log('Тест работы скрипта');
	const taskManager = new BX.TaskManager('#application');
	taskManager.start();
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
