<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotizaciones_productos".
 *
 * @property int $id
 * @property int $cotizaciones_id
 * @property int $producto_id
 * @property float $cantidad
 * @property float $precio_unitario
 * @property float $precio
 *
 * @property Productos $producto
 */
class CotizacionesProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cotizaciones_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cotizaciones_id', 'producto_id'], 'integer'],
            [['cantidad', 'precio_unitario', 'precio'], 'number'],
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
            'cotizaciones_id' => 'Cotizaciones ID',
            'producto_id' => 'Descripción del Producto',
            'cantidad' => 'Cant.',
            'precio_unitario' => 'Precio Unitario',
            'precio' => 'Precio Total',
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
