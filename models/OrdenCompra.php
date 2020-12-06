<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "orden_compra".
 *
 * @property int $id
 * @property string|null $nro_documento
 * @property int $proveedor_id
 * @property float $utilidad_total
 * @property string $fecha
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Proveedores $proveedor
 */
class OrdenCompra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orden_compra';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }     

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nro_documento', 'proveedor_id', 'fecha', 'utilidad_total'], 'required'],
            [['proveedor_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['utilidad_total'], 'number'],
            [['fecha'], 'required'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['nro_documento'], 'string', 'max' => 30],
            [['nro_documento'], 'unique'],
            [['proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::className(), 'targetAttribute' => ['proveedor_id' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nro_documento' => 'N° de Documento',
            'proveedor_id' => 'Proveedor',
            'utilidad_total' => 'Utilidad Total',
            'fecha' => 'Fecha',
            'status' => 'Estátus',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Proveedor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedores::className(), ['Id' => 'proveedor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(OrdenProductos::className(), ['orden_compra_id' => 'id']);
    } 

}
