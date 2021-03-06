<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CriticasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Criticas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="criticas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Criticas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'libro_id',
            'usuario_id',
            'valoracion',
            'comentario:ntext',
            //'fecha',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
