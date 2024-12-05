<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Departamento $model */

$this->title = $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Departamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="departamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codigo' => $model->codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codigo' => $model->codigo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'nombre',
            'presupuesto',
            'gastos',
            [
                'attribute' => 'logo',
                'format' => 'raw',
                'value' => function ($model) {
                    // Verificar si la ruta de la imagen es válida
                    if ($model->logo && file_exists(Yii::getAlias('@webroot/') . $model->logo)) {
                        // Devuelve el HTML para mostrar la imagen
                        return Html::img('@web/' . $model->logo, ['alt' => 'Logo', 'style' => 'max-width: 200px;']);
                    } else {
                        return 'No hay logo disponible'; // Mensaje si no hay imagen
                    }
                }
            ],
        ],
    ]) ?>

</div>