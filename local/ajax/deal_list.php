<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Crm\DealTable;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;

class DealApiController extends \CBitrixComponent implements Controllerable
{
    public function configureActions()
    {
        return [
            'getDeals' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(['POST']),
                ],
            ],
        ];
    }

    public function getDealsAction()
    {
        $deals = DealTable::getList([
            'select' => ['ID', 'TITLE', 'STAGE_ID', 'PROBABILITY'],
            'order'  => ['TITLE' => $_POST['sort'] ?? 'ASC']
        ]);

        $result = [];
        while ($deal = $deals->fetch()) {
            $result[] = $deal;
        }

        return ['deals' => $result];
    }
}

$api = new DealApiController();
echo json_encode($api->getDealsAction());
die();