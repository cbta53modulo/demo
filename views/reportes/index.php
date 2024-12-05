<?php
use yii\helpers\Html;
/** @var yii\web\View $this */
?>
<h1>reportes/index</h1>

<div class="card">
    <div class="card-header bg-secondary text-white">Selecciona un Reporte</div>
    <div class="card-body text-center">
        <div class="row">
            <div class="col-md-4"> <?= Html::a('Reporte 1', ['reporte1'], ['class' => 'btn btn-outline-success btn-block']) ?> </div>
            <div class="col-md-4"> <?= Html::a('Reporte 2', ['reporte2'], ['class' => 'btn btn-outline-success btn-block']) ?> </div>
            <div class="col-md-4"> <?= Html::a('Reporte 3', ['reporte3'], ['class' => 'btn btn-outline-success btn-block']) ?> </div>
        </div>
    </div>
</div>