<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Departamento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="departamento-form">

    <!-- //Primer cambio poner el atributo enctype="multipart/form-data" -->
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'presupuesto')->textInput() ?>

    <?= $form->field($model, 'gastos')->textInput() ?>
    <br>
    <?= $form->field($model, 'logo')->fileInput() ?>
    <br>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>