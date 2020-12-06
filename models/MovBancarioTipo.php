<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "mov_bancario_tipo".
 *
 * @property int $id
 * @property string|null $descripcion
 * @property int $tipo_movimiento 1 = Entrada, 2 = Salida
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property MovBancarios[] $movBancarios
 */
class MovBancarioTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mov_bancario_tipo';
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
            [['tipo_movimiento', 'descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['tipo_movimiento'], 'string', 'max' => 20],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'tipo_movimiento' => 'Tipo de Movimiento',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[MovBancarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovBancarios()
    {
        return $this->hasMany(MovBancarios::className(), ['tipo_movimiento_id' => 'id']);
    }
}
