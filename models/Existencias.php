<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "existencias".
 *
 * @property int $id
 * @property int $tienda_id
 * @property int $producto_id
 * @property float $cantidad
 *
 * @property Tiendas $tienda
 * @property Productos $producto
 */
class Existencias extends \yii\db\ActiveRecord
{
    public $categoria_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'existencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tienda_id', 'producto_id'], 'integer'],
            [['cantidad'], 'number'],
            [['tienda_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tiendas::className(), 'targetAttribute' => ['tienda_id' => 'Id']],
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
            'tienda_id' => 'Tienda',
            'producto_id' => 'Producto',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * Gets query for [[Tienda]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTienda()
    {
        return $this->hasOne(Tiendas::className(), ['Id' => 'tienda_id']);
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
