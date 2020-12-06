<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "libro_precios".
 *
 * @property int $id
 * @property string $descripcion  
 * @property int $tienda_id
 * @property string|null $fecha_inicio
 * @property string|null $fecha_fin
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Tiendas $tienda
 */
class LibroPrecios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libro_precios';
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
            [['descripcion', 'tienda_id', 'fecha_inicio', 'fecha_fin'], 'required'],
            [['tienda_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['descripcion'], 'string', 'max' => 255], 
            [['fecha_inicio', 'fecha_fin', 'created_at', 'updated_at'], 'safe'],
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
            'descripcion' => 'Descripción',
            'tienda_id' => 'Tienda',
            'fecha_inicio' => 'Fecha de Inicio',
            'fecha_fin' => 'Fecha Fin',
            'status' => 'Estátus',
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
}
