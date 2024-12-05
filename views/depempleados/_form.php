<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DepEmpleados $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dep-empleados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_empleado')->textInput() ?>

    <?= $form->field($model, 'id_departamento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
