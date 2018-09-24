<?php
/**
 * Created by PhpStorm.
 * User: SergLit
 * Date: 02.03.2018
 * Time: 18:06
 */

namespace common\models;
use paulzi\adjacencyList\AdjacencyListQueryTrait;

class MenuQuerys extends \yii\db\ActiveQuery
{
    use AdjacencyListQueryTrait;
}