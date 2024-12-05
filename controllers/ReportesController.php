<?php
namespace app\controllers;

use Yii;

class ReportesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReporte1()
    {
        // Recibimos los parametro para filtrado que vienen del formulario
        $nombre = Yii::$app->request->get('nombre');
        $nombre_depto = Yii::$app->request->get('nombre_depto');

        // Construye la consulta SQL base
        $sql = "SELECT e.nif, e.nombre, e.apellido1, e.apellido2, d.nombre AS Departamento
                FROM empleado e
	            INNER JOIN departamento d
		        ON e.codigo_departamento = d.codigo
                WHERE 1=1"; // Esta linea siempre es verdadera y permite agregar and de forma dinamica

        // Agrega condiciones de filtro dinámicamente si son mandados
        $params = [];
        if ($nombre) { // Si el parametro trae un valor
            $sql .= " AND e.nombre LIKE :nombre";
            $params[':nombre'] = "%$nombre%";
        }
        
        if ($nombre_depto) { // Si el parametro trae un valor
            $sql .= " AND d.nombre LIKE :nombre_depto";
            $params[':nombre_depto'] = "%$nombre_depto%";
        }        
      
        // Ejecuta la consulta
        $empleados = Yii::$app->db->createCommand($sql, $params)->queryAll();

        //Mandamos a la vista el conjunto de registros retornados en la variable $empleados
        return $this->render('reporte1', [
            'empleados' => $empleados,
        ]);
    }

    public function actionReporte2()
    {
        return $this->render('reporte2');
    }

    public function actionReporte3()
    {
        return $this->render('reporte3');
    }
}
