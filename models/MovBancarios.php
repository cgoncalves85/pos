<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "mov_bancarios".
 *
 * @property int $id
 * @property string $nro_referencia
 * @property int $banco_id
 * @property int $tipo_movimiento_id
 * @property float $valor
 * @property string|null $observacion
 * @property string|null $nota_impresion
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Bancos $banco
 * @property MovBancarioTipo $tipoMovimiento
 */
class MovBancarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mov_bancarios';
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
            [['nro_referencia', 'banco_id', 'tipo_movimiento_id', 'valor'], 'required'],
            [['banco_id', 'tipo_movimiento_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['valor'], 'number'],
            [['observacion', 'nota_impresion'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['nro_referencia'], 'string', 'max' => 255],
            [['banco_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bancos::className(), 'targetAttribute' => ['banco_id' => 'id']],
            [['tipo_movimiento_id'], 'exist', 'skipOnError' => true, 'targetClass' => MovBancarioTipo::className(), 'targetAttribute' => ['tipo_movimiento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nro_referencia' => 'N° de Referencia',
            'banco_id' => 'Banco',
            'tipo_movimiento_id' => 'Tipo de Movimiento',
            'valor' => 'Monto',
            'observacion' => 'Observación',
            'nota_impresion' => 'Nota de Impresión',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Banco]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBanco()
    {
        return $this->hasOne(Bancos::className(), ['id' => 'banco_id']);
    }

    /**
     * Gets query for [[TipoMovimiento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMovimiento()
    {
        return $this->hasOne(MovBancarioTipo::className(), ['id' => 'tipo_movimiento_id']);
    }
}
