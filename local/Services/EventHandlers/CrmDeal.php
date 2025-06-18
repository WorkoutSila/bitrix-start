<?php

namespace Services\EventHandlers;

\Bitrix\Main\Loader::includeModule('crm');

abstract class CrmDeal
{
    public static function OnBeforeCrmDealUpdate(&$fields)
    {

    }

    public static function OnAfterCrmDealUpdate($fields)
    {

    }

    public static function getDeal($dealId)
    {

    }
}