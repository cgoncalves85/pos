<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cajas_apertura".
 *
 * @property int $id
 * @property int $user_id
 * @property int $caja_id
 * @property string|null $fecha
 * @property float $monto_apertura
 * @property float $monto_cierre
 *
 * @property User $user
 * @property Cajas $caja
 */
class CajasApertura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cajas_apertura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'caja_id', 'status'], 'integer'],
            [['fecha'], 'safe'],
            [['monto_apertura', 'monto_cierre'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['caja_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cajas::className(), 'targetAttribute' => ['caja_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Usuario',
            'caja_id' => 'Caja',
            'fecha' => 'Fecha',
            'monto_apertura' => 'Monto  de Apertura',
            'monto_cierre' => 'Monto de Cierre',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Caja]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaja()
    {
        return $this->hasOne(Cajas::className(), ['id' => 'caja_id']);
    }
}
