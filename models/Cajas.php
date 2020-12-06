<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "cajas".
 *
 * @property int $id
 * @property float $nro 
 * @property string $descripcion
 * @property int $tienda_id
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Tiendas $tienda
 */
class Cajas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cajas';
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
            [['nro', 'descripcion', 'tienda_id'], 'required'],
            [['tienda_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['descripcion'], 'string', 'max' => 100],
            [['nro'], 'string', 'max' => 2],
            [['tienda_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tiendas::className(), 'targetAttribute' => ['tienda_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nro' => 'N°',
            'descripcion' => 'Descripción',
            'tienda_id' => 'Tienda',
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
        return $this->hasOne(Tiendas::className(), ['id' => 'tienda_id']);
    }
}
