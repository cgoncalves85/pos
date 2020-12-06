<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventario_productos".
 *
 * @property int $id
 * @property int $inventario_id
 * @property int $producto_id
 * @property float $cantidad
 *
 * @property Productos $producto
 */
class InventarioProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventario_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inventario_id', 'producto_id'], 'integer'],
            [['cantidad'], 'number'],
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
            'inventario_id' => 'Inventario ID',
            'producto_id' => 'Producto ID',
            'cantidad' => 'Cantidad',
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
