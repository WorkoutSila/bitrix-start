<?php

namespace Services\EventHandlers;


\Bitrix\Main\Loader::includeModule('crm');

abstract class CrmLead
{
    public static function OnAfterCrmLeadAdd($lead)
    {

    }
}