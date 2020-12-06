<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventario_auditoria_productos".
 *
 * @property int $id
 * @property int $inventario_auditoria_id
 * @property int $producto_id
 * @property float $cantidad
 * @property float $cantidad_final
 * @property string|null $observacion
 *
 * @property Productos $producto
 */
class InventarioAuditoriaProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventario_auditoria_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inventario_auditoria_id', 'producto_id'], 'integer'],
            [['cantidad', 'cantidad_final'], 'number'],
            [['observacion'], 'string'],
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
            'inventario_auditoria_id' => 'Inventario Auditoria ID',
            'producto_id' => 'Productos',
            'cantidad' => 'Cant.',
            'cantidad_final' => 'Cant. Final',
            'observacion' => 'Observación',
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
