<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Colocamos aquí el nombre de nuestro reporte.
$this->title = 'Reporte de Empleados';
?>

<h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

<div class="card mb-4">
    <div class="card-header bg-info text-white">Filtros de Búsqueda</div>
    <div class="card-body">

        <!-- Declaramos el formulario con la accion que apunta a nuestro controlador y la accion reporte1 -->
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['reportes/reporte1']]); ?>

        <!-- Declaramos los campos que seran enviados a nuestro reporte -->
        <div class="row">
            <div class="col-md-4">
                <?= Html::label('Nombre', 'nombre', ['class' => 'form-label']) ?>
                <?= Html::textInput('nombre', Yii::$app->request->get('nombre', ''), [
                    'placeholder' => 'Nombre',
                    'class' => 'form-control'
                ]) ?>
            </div>

            <div class="col-md-4">
                <?= Html::label('Departamento', 'nombre_depto', ['class' => 'form-label']) ?>
                <?= Html::textInput('nombre_depto', Yii::$app->request->get('nombre_depto', ''), [
                    'placeholder' => 'Nombre',
                    'class' => 'form-control'
                ]) ?>
            </div>

            <div class="col-md-4 d-flex align-items-end gap-2">
                <!-- Este boton hace el reporte -->
                <?= Html::submitButton('Generar Reporte', ['class' => 'btn btn-primary w-100']) ?>
                <?= Html::a('Regresar', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<!-- Si encontramos registros los metemos en una tabla html para ser mostrados, se envian desde la linea 41 -->
<?php if (!empty($empleados)): ?>
    <h2 class="mb-3">Resultados del Reporte</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">NIF</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido 1</th>
                    <th scope="col">Apellido 2</th>
                    <th scope="col">Departamento</th>                    
                </tr>
            </thead>
            <tbody>
                <!-- Recorremos cada registro y lo metemos en la celdas de la tabla -->
                <?php foreach ($empleados as $empleado): ?>
                    <tr class="table-light">
                        <!-- Cada campo debe councidir con la consulta SQL que realizamos previamente -->
                        <td><?= Html::encode($empleado['nif']) ?></td>
                        <td><?= Html::encode($empleado['nombre']) ?></td>
                        <td><?= Html::encode($empleado['apellido1']) ?></td>
                        <td><?= Html::encode($empleado['apellido2']) ?></td>
                        <td><?= Html::encode($empleado['Departamento']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="alert alert-warning">No se encontraron resultados para los filtros seleccionados.</p>
<?php endif; ?>