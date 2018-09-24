<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h3>Congratulations  young developer!</h3>

        <p class="lead"> Yii2-blog application.</p>

    </div>

    <div class="body-content">
        <div class="row">
            <?php foreach ($blogs as $one): ?>
            <div class="col-lg-4">
                <h2><?=$one->title?></h2>
                 <?=$one->text?>
            </div>
            <?php endforeach; ?>
            </div>
        </div>
</div>
