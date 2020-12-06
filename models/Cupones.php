<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cupones".
 *
 * @property int $id
 * @property int $id_lista
 * @property string $cupon
 * @property string $descripcion
 * @property int $porcentaje_descuento
 * @property int $status
 *
 * @property CuponesLista $lista
 */
class Cupones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cupones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lista', 'porcentaje_descuento', 'status'], 'integer'],
            [['descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['cupon'], 'string', 'max' => 255],
            //[['id_lista'], 'exist', 'skipOnError' => true, 'targetClass' => CuponesLista::className(), 'targetAttribute' => ['id_lista' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lista' => 'Id Lista',
            'cupon' => 'Cupon',
            'descripcion' => 'Descripcion',
            'porcentaje_descuento' => 'Porcentaje Descuento',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Lista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLista()
    {
        return $this->hasOne(CuponesLista::className(), ['id' => 'id_lista']);
    }
}
