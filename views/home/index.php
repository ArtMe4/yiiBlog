<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Articles */

$this->title = 'Все статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex justify-content-between align-items-center">
    <div>
        <?php
            echo Html::a('Предложить новость', ['add'], ['class' => 'btn btn-success']);
        ?>
    </div>
    <div>
        <?php echo 'Сортировать по: ' . $sort->link('time_add') ?>
    </div>
</div>

    <h1><?= Html::encode($this->title) ?></h1>

<div class="articles-index">
    <?php
        foreach ($posts as $el)
            echo '<div class="">Статья от пользователя ' . $el->name . '<br>' . $el->title . '<br>'.
                Html::a('Посмотреть', ['show', 'id' => $el->id], ['class' => 'btn btn-success'])
                .'</div>';
        ?>

    <?= LinkPager::widget([
        'pagination' => $pages,
    ]); ?>

</div>



