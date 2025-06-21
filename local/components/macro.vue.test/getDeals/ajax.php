<?php

namespace Local\Components\Macro\GetDeals;

// Запрет выполнения скрипта из браузера (по эндпоинту)
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

// Импорты и отработку ошибки взял как пример из исходников битрикса
use Bitrix\Main\Engine\Response;
use Bitrix\Main\Engine\Response\AjaxJson;
use Bitrix\Main\Error;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;

class ExampleAjaxController extends \Bitrix\Main\Engine\Controller
{
    	/**
	 * @return AjaxJson|Json|string[]
	 * @throws \Bitrix\Main\LoaderException
	 */
    public function listDealsAction()
		// Обязательно нужно было назвать класс с суффиксом Action (Но вызывать его почему-то надо уже без суффикса!!!)
    {
        if (!Loader::includeModule('crm'))
		{
			return $this->sendErrorResponse('Could not load "crm" module.');
		}
		// Получение списка сделок в виде объекта из ORM
        $deals = \Bitrix\Crm\DealTable::getList([
            'select' => ['ID', 'TITLE', 'OPPORTUNITY', 'CURRENCY_ID'],
            'limit' => 50,
        ]);

        $result = [];
        while ($deal = $deals->fetch()) {
            $result[] = $deal;
        }

        return Json::encode($result);
    }

    	private function sendErrorResponse(string $message)
	{
		$errorCollection = new ErrorCollection();
		$errorCollection->setError(new Error($message));

		return Response\AjaxJson::createError($errorCollection);
	}
}
?>