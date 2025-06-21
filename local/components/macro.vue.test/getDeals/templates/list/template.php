<?php
Bitrix\Main\UI\Extension::load("ui.vue");
define('VUEJS_DEBUG', true);

$arrItems = $arResult['DATA'];

// var_dump($arrItems);
?>


<div id="app"></div>

<script type="text/javascript">
  BX.Vue.create({
    el: '#app',

    data: {
    },
    template:
    `
    <h1>Hello Vue3!</h1>
    `
  })
</script>