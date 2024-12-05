<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dep_empleados".
 *
 * @property int $id
 * @property int $id_empleado
 * @property int $id_departamento
 *
 * @property Departamento $departamento
 * @property Empleado $empleado
 */
class DepEmpleados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dep_empleados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empleado', 'id_departamento'], 'required'],
            [['id_empleado', 'id_departamento'], 'integer'],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::class, 'targetAttribute' => ['id_departamento' => 'codigo']],
            [['id_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::class, 'targetAttribute' => ['id_empleado' => 'codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_empleado' => 'Id Empleado',
            'id_departamento' => 'Id Departamento',
        ];
    }

    /**
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery|DepartamentoQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamento::class, ['codigo' => 'id_departamento']);
    }

    /**
     * Gets query for [[Empleado]].
     *
     * @return \yii\db\ActiveQuery|EmpleadoQuery
     */
    public function getEmpleado()
    {
        return $this->hasOne(Empleado::class, ['codigo' => 'id_empleado']);
    }

    /**
     * {@inheritdoc}
     * @return DepEmpleadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepEmpleadosQuery(get_called_class());
    }
}
