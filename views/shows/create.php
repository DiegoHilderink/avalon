<?php

use kartik\datecontrol\DateControl;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Shows */

$this->title = 'Create Shows';

$js = "arr = { '#imageform-imagen': '#setImg'}

    $.each(arr, (k, v) => {
        $(k).change(function () {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == 'gif' || ext == 'png' || ext == 'jpeg' || ext == 'jpg')) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(v).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $(v).attr('src', '/assets/no_preview.png');
            }
        });
    });

    $('#i0').val('cine');
    $('#i1').val('series');
";

$this->registerJs($js);
?>
<div class="shows-create">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-2  col-sm-12">
            <span class="btn btn-default btn-file">
                <img id="setImg" src="<?= Yii::getAlias('@imgUrl/plus.png') ?>" class="plus" alt="">
                <?= $form->field($imagen, 'imagen')->fileInput(['class' => ''])->label(false) ?>
            </span>
        </div>

        <div class="col-lg-9  col-sm-12">

            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'productora_id')->hiddenInput(['value' => $empresa])->label(false) ?>

            <?= $form->field($model, 'tipo')->hiddenInput(['value' => $tipo])->label(false) ?>

            <?= $form->field($model, 'pais_id')->dropDownList($paises) ?>

            <?php echo $form->field($model, 'fecha')->widget(DateControl::class, [
                'type' => DateControl::FORMAT_DATE,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'autoclose' => true,
                    ],
                ],
            ]) ?>

            <?= $form->field($model, 'sinopsis')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Crear', ['class' => 'btn btn-orange']) ?>
        <?= Html::a(
            'Cancelar',
            ['peliculas'],
            [
                'class' => 'btn btn-orange',
            ]
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>