<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libro_precios_productos".
 *
 * @property int $id
 * @property int $libro_precio_id
 * @property int $producto_id
 * @property float $precio
 *
 * @property Productos $producto
 */
class LibroPreciosProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libro_precios_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libro_precio_id', 'producto_id'], 'integer'],
            [['precio'], 'number'],
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
            'libro_precio_id' => 'Libro Precio ID',
            'producto_id' => 'Descripción del Producto',
            'precio' => 'Precio',
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
