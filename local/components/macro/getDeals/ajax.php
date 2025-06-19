<?php

namespace Local\Components\Macro\GetDeals;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Engine\Response;
use Bitrix\Main\Engine\Response\AjaxJson;
use Bitrix\Main\Error;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use \Bitrix\Main\Web\Json;

class ExampleAjaxController extends \Bitrix\Main\Engine\Controller
{
    	/**
	 * @return AjaxJson|Json|string[]
	 * @throws \Bitrix\Main\LoaderException
	 */
    public function listDealsAction()
    {
        if (!Loader::includeModule('crm'))
		{
			return $this->sendErrorResponse('Could not load "crm" module.');
		}

        $deals = \Bitrix\Crm\DealTable::getList([
            'select' => ['ID', 'TITLE', 'OPPORTUNITY', 'CURRENCY_ID'],
            'limit' => 50,
        ]);

        $result = [];
        while ($deal = $deals->fetch()) {
            $result[] = $deal;
        }

        return \Bitrix\Main\Web\Json::encode($result);
    }

    	private function sendErrorResponse(string $message)
	{
		$errorCollection = new ErrorCollection();
		$errorCollection->setError(new Error($message));

		return Response\AjaxJson::createError($errorCollection);
	}
}
?>