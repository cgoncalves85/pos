<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orden_productos".
 *
 * @property int $id
 * @property int $orden_compra_id
 * @property int $producto_id
 * @property float $cantidad
 * @property float $precio_compra
 * @property float $precio_venta
 * @property float $utilidad
 *
 * @property Productos $producto
 */
class OrdenProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orden_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orden_compra_id', 'producto_id'], 'integer'],
            [['cantidad', 'precio_compra', 'precio_venta', 'utilidad'], 'number'],
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
            'orden_compra_id' => 'Orden Compra ID',
            'producto_id' => 'Producto',
            'cantidad' => 'Cantidad',
            'precio_compra' => 'Precio de Compra',
            'precio_venta' => 'Precio de Venta',
            'utilidad' => 'Utilidad',
        ];
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
