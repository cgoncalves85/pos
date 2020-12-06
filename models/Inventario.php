<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "inventario".
 *
 * @property int $id
 * @property string $tipo_movimiento
 * @property string $nro_documento
 * @property string $fecha
 * @property int $tienda_id
 * @property int|null $orden_compra_id
 * @property string $observacion
 * @property int|null $tienda_origen_id
 * @property int|null $tienda_destino_id
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property OrdenCompra $ordenCompra
 * @property Tiendas $tiendaOrigen
 * @property Tiendas $tiendaDestino
 * @property Tiendas $tienda
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventario';
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
            [['nro_documento', 'fecha'], 'required'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['tienda_id', 'orden_compra_id', 'tienda_origen_id', 'tienda_destino_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['tipo_movimiento', 'observacion'], 'string', 'max' => 255],
            [['nro_documento'], 'string', 'max' => 30],
            [['orden_compra_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenCompra::className(), 'targetAttribute' => ['orden_compra_id' => 'id']],
            [['tienda_origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tiendas::className(), 'targetAttribute' => ['tienda_origen_id' => 'id']],
            [['tienda_destino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tiendas::className(), 'targetAttribute' => ['tienda_destino_id' => 'id']],
            [['tienda_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tiendas::className(), 'targetAttribute' => ['tienda_id' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_movimiento' => 'Tipo de Movimiento',
            'nro_documento' => 'N° de Documento',
            'fecha' => 'Fecha',
            'tienda_id' => 'Tienda',
            'orden_compra_id' => 'Orden de Compra',
            'observacion' => 'Observación',
            'tienda_origen_id' => 'Tienda Origen',
            'tienda_destino_id' => 'Tienda de Destino',
            'status' => 'Estátus',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[OrdenCompra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCompra()
    {
        return $this->hasOne(OrdenCompra::className(), ['id' => 'orden_compra_id']);
    }

    /**
     * Gets query for [[TiendaOrigen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiendaOrigen()
    {
        return $this->hasOne(Tiendas::className(), ['id' => 'tienda_origen_id']);
    }

    /**
     * Gets query for [[TiendaDestino]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiendaDestino()
    {
        return $this->hasOne(Tiendas::className(), ['id' => 'tienda_destino_id']);
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
}
