<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Home */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<a class="btn btn-success" href="/home">Назад</a>

    <h1><?= Html::encode($this->title) ?></h1>

<div>
    <?php
        echo '<p>Автор статьи: '. $model->name .'</p>
             <p>'. $model->text .'</p>
             <p>'. $model->link .'</p>';
    ?>

</div>


