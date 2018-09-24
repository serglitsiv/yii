<?php

use kartik\tree\TreeView;
use common\models\KartikMenu;
use yii\helpers\Url;

$this->title = 'Tree';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tree-index">

<?= TreeView::widget([
    'query' => KartikMenu::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => 'Categories'],
    'fontAwesome' => true,     // optional
    'isAdmin' => true,         // optional (toggle to enable admin mode)
    'displayValue' => 1,        // initial display value
    'softDelete' => true,
    'cacheSettings' => [
        'enableCache' => false  // defaults to true
    ],
    'nodeAddlViews' => [
        kartik\tree\Module::VIEW_PART_2 => '@backend/views/tree/_form',

    ]



]);

?>

</div>
