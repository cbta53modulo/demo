<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamento".
 *
 * @property int $codigo
 * @property string $nombre
 * @property float $presupuesto
 * @property float $gastos
 * @property string $logo
 *
 * @property DepEmpleados[] $depEmpleados
 * @property Empleado[] $empleados
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'presupuesto', 'gastos'], 'required'],
            [['presupuesto', 'gastos'], 'number'],            
            [['nombre', 'logo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'presupuesto' => 'Presupuesto',
            'gastos' => 'Gastos',
            'logo' => 'Logo',            
        ];
    }

    /**
     * Gets query for [[DepEmpleados]].
     *
     * @return \yii\db\ActiveQuery|DepEmpleadosQuery
     */
    public function getDepEmpleados()
    {
        return $this->hasMany(DepEmpleados::class, ['id_departamento' => 'codigo']);
    }

    /**
     * Gets query for [[Empleados]].
     *
     * @return \yii\db\ActiveQuery|EmpleadoQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::class, ['codigo_departamento' => 'codigo']);
    }

    /**
     * {@inheritdoc}
     * @return DepartamentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepartamentoQuery(get_called_class());
    }
}
