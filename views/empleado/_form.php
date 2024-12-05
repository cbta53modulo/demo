<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Departamento;

/** @var yii\web\View $this */
/** @var app\models\Empleado $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="empleado-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo_departamento')->dropDownList(
        ArrayHelper::map(Departamento::find()->all(), 'codigo', 'nombre'),
        ['prompt' => 'Selecciona un Depa']
    )
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>