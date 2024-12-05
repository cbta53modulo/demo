<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DepEmpleados]].
 *
 * @see DepEmpleados
 */
class DepEmpleadosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DepEmpleados[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DepEmpleados|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
