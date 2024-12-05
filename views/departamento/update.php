<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Departamento $model */

$this->title = 'Update Departamento: ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo, 'url' => ['view', 'codigo' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="departamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
