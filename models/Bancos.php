<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "bancos".
 *
 * @property int $id
 * @property int $banco_operador_id
 * @property string $nro_cuenta
 * @property string|null $descripcion_cuenta
 * @property float $saldo_inicial
 * @property float $saldo_disponible
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property BancoOperador $bancoOperador
 */
class Bancos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bancos';
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
            [['banco_operador_id', 'nro_cuenta', 'saldo_inicial', 'status'], 'required'],
            [['banco_operador_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['descripcion_cuenta'], 'string'],
            [['saldo_inicial', 'saldo_disponible'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['nro_cuenta'], 'string', 'max' => 255],
            [['banco_operador_id'], 'exist', 'skipOnError' => true, 'targetClass' => BancoOperador::className(), 'targetAttribute' => ['banco_operador_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banco_operador_id' => 'Banco',
            'nro_cuenta' => 'N° de Cuenta',
            'descripcion_cuenta' => 'Descripción',
            'saldo_inicial' => 'Saldo Inicial',
            'saldo_disponible' => 'Saldo Disponible',
            'status' => 'Estado de la Cuenta',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[BancoOperador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBancoOperador()
    {
        return $this->hasOne(BancoOperador::className(), ['id' => 'banco_operador_id']);
    }
}
