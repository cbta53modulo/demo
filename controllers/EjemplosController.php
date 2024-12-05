<?php

namespace app\controllers;

use Yii;

class EjemplosController extends \yii\web\Controller
{


    // Lista de consultas
    private const QUERIES = [
        'consulta1' => 'SELECT nombre, presupuesto, gastos, (gastos / presupuesto) * 100 AS p_gasto 
                        FROM departamento 
                        WHERE gastos / presupuesto < :param1 
                        ORDER BY p_gasto DESC;',
        'consulta2' => 'SELECT d.nombre AS depa, COUNT(e.codigo) AS cantidad_empleados
                        FROM empleado e
                            INNER JOIN departamento d ON e.codigo_departamento = d.codigo
                        GROUP BY d.codigo
                        HAVING COUNT(e.codigo)>:param1',
        'consulta3' => 'SELECT e.nombre, e.apellido1, e.apellido2, d.nombre, d.presupuesto
                        FROM empleado e
                        INNER JOIN departamento d ON e.codigo_departamento = d.codigo
                        WHERE d.presupuesto BETWEEN :param1 AND :param2',

        'consulta4' => 'SELECT e.nif, e.nombre, e.apellido1, n.f_pago
                        FROM nomina n
                        INNER JOIN empleado e ON e.codigo = n.id_empleado
                        WHERE f_pago > :param1;',
        'consulta5' => 'SELECT * FROM empleado
                        WHERE codigo_departamento = :param1',
        'consulta6' => 'SELECT * FROM empleado
                        WHERE codigo_departamento = :param1',
        'consulta7' => 'SELECT e.nombre, e.apellido1, e.apellido2, d.nombre
                        FROM empleado e
                        INNER JOIN departamento d ON e.codigo_departamento = d.codigo                        
                        ',
        'consulta8' => '',
        'consulta9' => '',
        'consulta10' => ''


    ];

    public function actionIndex()
    {
        return $this->render('index', ['queries' => self::QUERIES]);
    }

    public function actionDynamicReport()
    {
        $queryId = Yii::$app->request->post('queryId'); // Identificador de consulta
        $param1 = Yii::$app->request->post('parametro1'); // Primer parámetro
        $param2 = Yii::$app->request->post('parametro2'); // Segundo parámetro

        $results = [];
        $params = [];

        $sql = self::QUERIES[$queryId] ?? null; // Recupera la consulta por ID

        if ($sql) {
            // Identifica la consulta según el botón presionado
            switch ($queryId) {
                case 'consulta1':
                    $params = [
                        ':param1' => "$param1"
                    ];
                    break;

                case 'consulta2':
                    // Como el valor es un texto, lo pegamos directamente para evitar errores.
                    $sql .= " ORDER BY depa $param2;";
                    $params = [
                        ':param1' => $param1,
                    ];
                    break;

                case 'consulta3':
                    $params = [
                        ':param1' => $param1,
                        ':param2' => $param2,
                    ];
                    break;

                case 'consulta4':
                    $params = [
                        ':param1' => $param1
                    ];
                    break;

                case 'consulta5':
                    $params = [
                        ':param1' => $param1
                    ];
                    break;
                case 'consulta6':
                    $params = [
                        ':param1' => $param1
                    ];
                    break;
                case 'consulta7':
                    //Aseguramos que venta algo seleccionado
                    if (!empty($param1) && is_array($param1)) {
                        $param1IN = implode(',', array_map('intval', $param1)); // Asegura que los valores sean enteros
                        $sql .= "WHERE d.codigo IN ($param1IN)";
                    }
                    break;
                default:
                    $sql = false;
                    break;
            }
        }
        if (!empty($sql)) {
            $results = Yii::$app->db->createCommand($sql)->bindValues($params)->queryAll();
        }

        return $this->render('dynamic-report', [
            'results' => $results,
            'queryId' => $queryId,
        ]);
    }
}
