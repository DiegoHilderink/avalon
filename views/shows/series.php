<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShowsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Series';
?>
<div class="shows-series row">
    <div class="col-sm-12 col-lg-2 lg-border-right">
        <?php $form = ActiveForm::begin([
            'action' => ['shows/series'],
            'method' => 'get',
        ]); ?>

        <div class="form-group">
            <?= Html::textInput(
                'dataName',
                $dataName,
                ['class' =>  'form-control', 'value' => '', 'placeholder' => 'Palabra clave...', 'id' =>  'dataName']
            ) ?>
        </div>

        <?= Html::submitButton('Buscar', ['class' => 'btn btn-orange w-100 mb-2']) ?>

        <?php ActiveForm::end(); ?>
        <?php if (isset(Yii::$app->user->identity) && Yii::$app->user->identity->clave === null) : ?>
            <?= Html::a(
                'Añade tu serie',
                ['create', 'tipo' => 'serie'],
                [
                    'class' => 'btn btn-orange btn-block mb-2',
                ]
            ) ?>
        <?php endif ?>
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center font-weight-bold">Ordenar por:</li>
            <li class="list-group-item text-center"><?= $sort->link('nombre') ?></li>
            <li class="list-group-item text-center font-orange"><?= $sort->link('productora') ?></li>
        </ul>
    </div>
    <div class="col-sm-12 col-lg-8">
        <div class="row">
            <?php foreach ($shows as $shows) : ?>
                <div class="col-lg-3 col-sm-6 d-flex justify-content-center">
                    <div class="card mt-2" style="width: 15rem;">
                        <img class="card-img-top mw-100 mh-100" src="<?= Yii::getAlias('@imgCineUrl/' . $shows->id . '.jpg') ?>" onerror="this.src = '<?= Yii::getAlias('@imgUrl/notfound.jpg') ?>'" alt="Card image cap">
                        <?= Html::a(
                            $shows->nombre,
                            ['shows/view', 'id' => $shows->id],
                            [
                                'class' => 'btn btn-dark btn-block card-body d-flex flex-column mt-auto',
                            ]
                        ) ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>