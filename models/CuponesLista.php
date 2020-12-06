<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "cupones_lista".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $cantidad_cupones
 * @property int $porcentaje_descuento
 * @property string|null $fecha_inicio
 * @property string|null $fecha_fin
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Cupones[] $cupones
 */
class CuponesLista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cupones_lista';
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
            [['descripcion', 'cantidad_cupones', 'porcentaje_descuento'], 'required'],
            [['porcentaje_descuento'], 'integer'],
            [['descripcion'], 'string'],
            [['cantidad_cupones', 'status', 'created_by', 'updated_by'], 'integer'],
            [['fecha_inicio', 'fecha_fin', 'created_at', 'updated_at'], 'safe'],
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
            'cantidad_cupones' => 'N° de Cupones',
            'porcentaje_descuento' => '% Descuento',
            'fecha_inicio' => 'Fecha de Inicio',
            'fecha_fin' => 'Fecha de Caducidad',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Cupones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCupones()
    {
        return $this->hasMany(Cupones::className(), ['id_lista' => 'id']);
    }
}
