<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DepEmpleados $model */

$this->title = 'Update Dep Empleados: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dep Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dep-empleados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
