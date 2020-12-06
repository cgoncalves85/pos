<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventas_productos".
 *
 * @property int $id
 * @property int $venta_id
 * @property int $producto_id
 * @property float $cantidad
 *
 * @property Ventas $venta
 * @property Productos $producto
 */
class VentasProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ventas_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['venta_id', 'producto_id'], 'integer'],
            [['cantidad'], 'number'],
            [['venta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ventas::className(), 'targetAttribute' => ['venta_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['producto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'venta_id' => 'Venta ID',
            'producto_id' => 'Producto ID',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * Gets query for [[Venta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVenta()
    {
        return $this->hasOne(Ventas::className(), ['id' => 'venta_id']);
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Productos::className(), ['id' => 'producto_id']);
    }
}
