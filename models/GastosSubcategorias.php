<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "gastos_subcategorias".
 *
 * @property int $id
 * @property int $gastos_categorias_id
 * @property string $subcategoria
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Gastos[] $gastos
 * @property GastosCategorias $gastosCategorias
 */
class GastosSubcategorias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gastos_subcategorias';
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
            [['gastos_categorias_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['subcategoria'], 'string', 'max' => 255],
            [['gastos_categorias_id'], 'exist', 'skipOnError' => true, 'targetClass' => GastosCategorias::className(), 'targetAttribute' => ['gastos_categorias_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gastos_categorias_id' => 'Gastos Categorias ID',
            'subcategoria' => 'Subcategoria',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Gastos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGastos()
    {
        return $this->hasMany(Gastos::className(), ['gastos_subcategorias_id' => 'id']);
    }

    /**
     * Gets query for [[GastosCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGastosCategorias()
    {
        return $this->hasOne(GastosCategorias::className(), ['id' => 'gastos_categorias_id']);
    }
}
