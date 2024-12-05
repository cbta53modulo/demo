<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EmpleadoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="empleado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'nif') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido1') ?>

    <?= $form->field($model, 'apellido2') ?>

    <?php // echo $form->field($model, 'codigo_departamento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
