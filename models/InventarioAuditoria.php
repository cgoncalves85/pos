<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "inventario_auditoria".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $fecha
 * @property int $tienda_id
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Tiendas $tienda
 */
class InventarioAuditoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventario_auditoria';
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
            [['descripcion', 'tienda_id', 'fecha'], 'required'],
            [['descripcion'], 'string'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['tienda_id', 'status', 'created_by', 'updated_by'], 'integer'],
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
            'descripcion' => 'Descripción del Inventario',
            'fecha' => 'Fecha de Inventario',
            'tienda_id' => 'Tienda',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(InventarioAuditoriaProductos::className(), ['inventario_auditoria_id' => 'id']);
    }     
}
