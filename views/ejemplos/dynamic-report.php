<?php
use yii\helpers\Html;

// Encabezado para mostrar la consulta seleccionada
echo "<h3>Resultados de la consulta: " . Html::encode($queryId) . "</h3>";

// Imprime los resultados en una tabla
if (!empty($results)) {
    echo "<table class='table table-bordered'>";
    echo "<thead><tr>";

    // Generar encabezados dinámicos
    foreach (array_keys($results[0]) as $key) {
        echo "<th>" . Html::encode($key) . "</th>";
    }
    echo "</tr></thead><tbody>";

    // Generar filas dinámicas
    foreach ($results as $row) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . Html::encode($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No hay resultados para esta consulta.</p>";
}
?>
<?= Html::a('Regresar', ['index'], ['class' => 'btn btn-secondary']) ?>