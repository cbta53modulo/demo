<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleado".
 *
 * @property int $codigo
 * @property string $nif
 * @property string $nombre
 * @property string $apellido1
 * @property string|null $apellido2
 * @property int|null $codigo_departamento
 *
 * @property Departamento $codigoDepartamento
 */
class Empleado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nif', 'nombre', 'apellido1'], 'required'],
            [['codigo_departamento'], 'integer'],
            [['nif'], 'string', 'max' => 9],
            [['nombre', 'apellido1', 'apellido2'], 'string', 'max' => 100],
            [['nif'], 'unique'],
            [['codigo_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::class, 'targetAttribute' => ['codigo_departamento' => 'codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'nif' => 'Nif',
            'nombre' => 'Nombre',
            'apellido1' => 'Apellido1',
            'apellido2' => 'Apellido2',
            'codigo_departamento' => 'Codigo Departamento',
        ];
    }

    /**
     * Gets query for [[CodigoDepartamento]].
     *
     * @return \yii\db\ActiveQuery|DepartamentoQuery
     */
    public function getCodigoDepartamento()
    {
        return $this->hasOne(Departamento::class, ['codigo' => 'codigo_departamento']);
    }

    /**
     * {@inheritdoc}
     * @return EmpleadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmpleadoQuery(get_called_class());
    }
}
