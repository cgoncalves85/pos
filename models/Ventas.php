<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "ventas".
 *
 * @property int $id
 * @property int $user_id
 * @property int $caja_id
 * @property int $nro_documento
 * @property string|null $fecha
 * @property int $cliente_id
 * @property float $subtotal
 * @property float $impuesto
 * @property float $total
 * @property int $forma_pago_id
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property User $user
 * @property Cajas $caja
 * @property Clientes $cliente
 * @property FormaPago $formaPago
 * @property VentasProductos[] $ventasProductos
 */
class Ventas extends \yii\db\ActiveRecord
{
    public $valor_descuento;
    public $total_pay;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ventas';
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
            [['cliente_id', 'subtotal', 'impuesto', 'total'], 'required'],
            [['user_id', 'caja_id', 'nro_documento', 'cliente_id', 'forma_pago_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['subtotal', 'impuesto', 'total'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['caja_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cajas::className(), 'targetAttribute' => ['caja_id' => 'id']],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['forma_pago_id'], 'exist', 'skipOnError' => true, 'targetClass' => FormaPago::className(), 'targetAttribute' => ['forma_pago_id' => 'id']],
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
            'nro_documento' => 'N° de Documento',
            'fecha' => 'Fecha',
            'cliente_id' => 'Cliente',
            'subtotal' => 'Subtotal',
            'impuesto' => 'Impuesto',
            'total' => 'Total',
            'forma_pago_id' => 'Forma Pago',
            'status' => 'Estátus',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
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

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[VentasProductos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentasProductos()
    {
        return $this->hasMany(VentasProductos::className(), ['venta_id' => 'id']);
    }

    /**
    * Gets query for [[FormaPago]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getFormaPago() 
   { 
       return $this->hasOne(FormaPago::className(), ['id' => 'forma_pago_id']); 
   } 

}
