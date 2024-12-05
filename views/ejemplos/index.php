<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Estilos para resaltar las consultas SQL
$this->registerCss("
    .sql-code {
        font-family: 'Courier New', Courier, monospace;
        background-color: #f5f5f5;
        color: #2b2b2b;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        display: inline-block;
        white-space: pre-wrap;
        width: 100%;
    }
    .sql-keyword {
        color: #d73a49;
        font-weight: bold;
    }
    .sql-string {
        color: #032f62;
    }
    .sql-param {
        color: #6f42c1;
    }
");

// Función para limpiar y resaltar la consulta SQL
function formatSql($sql)
{
    // Dividir la consulta en líneas por salto de línea
    $lines = explode("\n", $sql);

    // Limpiar espacios redundantes en cada línea y preservar los saltos
    $cleanedLines = array_map(function ($line) {
        return preg_replace('/\s+/', ' ', trim($line));
    }, $lines);

    // Reunir las líneas ya limpias
    $cleanedSql = implode("\n", $cleanedLines);

    // Resaltar palabras clave SQL
    $cleanedSql = preg_replace(
        '/\b(SELECT|FROM|WHERE|AND|GROUP BY|HAVING|SUM|COUNT|BETWEEN|LIKE|ON|INNER JOIN|AS|OR|LIMIT|ORDER BY)\b/i',
        '<span class="sql-keyword">$1</span>',
        Html::encode($cleanedSql)
    );

    // Resaltar parámetros
    $cleanedSql = preg_replace('/(:\w+)/', '<span class="sql-param">$1</span>', $cleanedSql);

    // Resaltar cadenas de texto
    $cleanedSql = preg_replace('/\'(.*?)\'/', '<span class="sql-string">\'$1\'</span>', $cleanedSql);

    return $cleanedSql;
}

// Crear la tabla
echo "<table class='table table-bordered'>";
echo "<thead>
        <tr>
            <th>Consulta SQL</th>
            <th>Parámetros</th>            
            <th>Ejecutar</th>
        </tr>
      </thead>
      <tbody>";

// Cada renglon de la tabla tiene una consulta con sus dos parametros y su propio formulario, 
// los parametros son enviados por varios tipos de controles html y procesados en el controlador

// *********************************************** Consulta 1 **********************************
$sql = $queries['consulta1'];
$highlightedSql = formatSql($sql);
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 1: Un parametro<div class='sql-code'>$highlightedSql</div></td>";
echo "<td>";
echo "Parametro 1: " . Html::input('number', 'parametro1', '', ['class' => 'form-control']);
echo "<br>";
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta1'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

// *********************************************** Consulta 2 **********************************
// Utiliza un input radio par el ordenamiento
$sql = $queries['consulta2'];
$highlightedSql = formatSql($sql);
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 2: Having con parametro en radio y order by <div class='sql-code'>$highlightedSql</div></td>";
echo "<td>";
// Usamos un input para asegurar que nos llegen solo enteros
echo "Parametro 1: " . Html::input('number', 'parametro1', '', ['class' => 'form-control']);
echo "Parametro 2" . Html::radioList('parametro2', 'ASC', [
    'ASC' => 'Ascendente',
    'DESC' => 'Descendente',
], ['class' => 'form-control']);
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta2'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

// *********************************************** Consulta 3 **********************************
$sql = $queries['consulta3'];
$highlightedSql = formatSql($sql);
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 3:BETWEEN con dos parametros<div class='sql-code'>$highlightedSql</div></td>";
echo "<td>";
echo "Parametro 1: " . Html::textInput('parametro1', '', ['class' => 'form-control']);
echo "Parametro 2: " . Html::textInput('parametro2', '', ['class' => 'form-control']) . "<br>";
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta3'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

// *********************************************** Consulta 4 **********************************
// Consutas con fecha
$sql = $queries['consulta4'];
$highlightedSql = formatSql($sql);
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 4: Fechas 1 parametro<div class='sql-code'>$highlightedSql</div></td>";
echo "<td>";
echo "Parametro 1: " . Html::input('date', 'parametro1', '', ['class' => 'form-control']);
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta4'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

// *********************************************** Consulta 5 **********************************
$sql = $queries['consulta5'];
$highlightedSql = formatSql($sql);
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 5: Lista estatica<div class='sql-code'>$highlightedSql</div></td>";
echo "<td>";
echo "Parametro 1: " . Html::dropDownList(
    'parametro1', // Nombre del campo
    null, // Valor seleccionado (inicialmente ninguno)
    [ // Opciones para el dropdown
        1 => 'Desarrollo',
        2 => 'Sistemas',
        3 => 'Recursos Humanos',
        4 => 'Contabilidad',
        // aqui pondrias mas
    ],
    ['class' => 'form-control', 'prompt' => 'Seleccione una opción'] // Atributos HTML adicionales
);

echo "<br>";
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta5'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

// *********************************************** Consulta 6 **********************************
$sql = $queries['consulta6'];
$highlightedSql = formatSql($sql);

// Consulta SQL directa para obtener los depas
$depas = Yii::$app->db->createCommand('SELECT codigo, nombre FROM departamento')->queryAll();

// Convertir el resultado en un array adecuado para el dropdown
$depasDropdown = [];
foreach ($depas as $depa) {
    $depasDropdown[$depa['codigo']] = $depa['nombre'];
}

//iniciamos el form
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 6:Lista desde base de datos.<div class='sql-code'>$highlightedSql</div></td>";
echo "<td>";
echo "Parametro 1:" . Html::dropDownList(
    'parametro1', // Nombre del campo
    null, // Valor seleccionado
    $depasDropdown, // Opciones cargadas desde la base de datos
    ['class' => 'form-control', 'prompt' => 'Seleccione una opcion'] // Atributos adicionales
);
echo "<br>";
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta6'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

// *********************************************** Consulta 7 **********************************
$sql = $queries['consulta7'];
$highlightedSql = formatSql($sql);
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 7: IN<div class='sql-code'>$highlightedSql--El WHERE d.codigo IN () ira en la otra parte por se numeros</div></td>";
echo "<td>";
echo "Parametro 1:<br>";
echo Html::checkbox('parametro1[]', true, ['value' => 1, 'label' => 'Desarrollo']) . "<br>";
echo Html::checkbox('parametro1[]', false, ['value' => 2, 'label' => 'Sistemas']) . "<br>";
echo Html::checkbox('parametro1[]', false, ['value' => 3, 'label' => 'Recursos Humanos']) . "<br>";
echo "<br>";
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta7'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

// *********************************************** Consulta 8 **********************************
$sql = $queries['consulta8'];
$highlightedSql = formatSql($sql);
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 8: Decimal con input numerico<div class='sql-code'>$highlightedSql</div></td>";
echo "<td>";
echo "Parametro 1: " . Html::input('number', 'parametro1', '', [
    'class' => 'form-control',
    'step' => '0.1', // Permite decimales
]);
echo "<br>";
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta8'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

// *********************************************** Consulta 9 **********************************
$sql = $queries['consulta9'];
$highlightedSql = formatSql($sql);
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 9:<div class='sql-code'>$highlightedSql</div></td>";
echo "<td>";
echo "Parametro 1: " . Html::textInput('parametro1', '', ['class' => 'form-control']);
echo "Parametro 2: " . Html::textInput('parametro2', '', ['class' => 'form-control']) . "<br>";
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta9'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

// *********************************************** Consulta 10 **********************************
$sql = $queries['consulta10'];
$highlightedSql = formatSql($sql);
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['ejemplos/dynamic-report'],
]);

echo "<tr>";
echo "<td>Consulta 10:<div class='sql-code'>$highlightedSql</div></td>";
echo "<td>";
echo "Parametro 1: " . Html::textInput('parametro1', '', ['class' => 'form-control']);
echo "Parametro 2: " . Html::textInput('parametro2', '', ['class' => 'form-control']) . "<br>";
echo "</td>";
echo "<td>";
echo Html::hiddenInput('queryId', 'consulta10'); // Identificador de consulta
echo Html::submitButton('Ejecutar', ['class' => 'btn btn-primary']);
echo "</td>";
echo "</tr>";

ActiveForm::end();
// *********************************************************************************************

//cerramos la tabla
echo "</tbody></table>";
