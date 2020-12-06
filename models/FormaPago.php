<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forma_pago".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $status
 *
 * @property Ventas[] $ventas
 */
class FormaPago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forma_pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::className(), ['forma_pago_id' => 'id']);
    }
}
