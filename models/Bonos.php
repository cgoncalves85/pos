<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "bonos".
 *
 * @property int $id
 * @property int $tipo_bono 1= Descuento 2 = Premio
 * @property float $cantidad_puntos
 * @property string|null $premio
 * @property float|null $porcentaje_dcto
 * @property string|null $observacion
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class Bonos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bonos';
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
            [['cantidad_puntos', 'tipo_bono'], 'required'],
            [['tipo_bono', 'status', 'created_by', 'updated_by'], 'integer'],
            [['cantidad_puntos', 'porcentaje_dcto'], 'number'],
            [['observacion'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['premio'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_bono' => 'Tipo de Bono',
            'cantidad_puntos' => 'Cant. de Puntos',
            'premio' => 'Premio',
            'porcentaje_dcto' => 'Descuento (%)',
            'observacion' => 'Observación',
            'status' => 'Estado',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
