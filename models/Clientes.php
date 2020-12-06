<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id
 * @property string $nombre
 * @property string $tipo_identificacion
 * @property string $nro_identificacion
 * @property string|null $correo
 * @property string|null $telefono
 * @property string|null $movil
 * @property string|null $direccion
 * @property int $credito 
 * @property float|null $monto_credito 
 * @property float $puntos
 * @property int $categoria_cliente_id 
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property ClientesCategorias $categoriaCliente 
 * @property Cotizaciones[] $cotizaciones 
 * @property Ventas[] $ventas
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
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
            [['nombre', 'nro_identificacion', 'correo'], 'required'],
            [['direccion'], 'string'],
            [['monto_credito', 'puntos'], 'number'],
            [['status', 'categoria_cliente_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'correo'], 'string', 'max' => 255],
            [['tipo_identificacion', 'telefono', 'movil'], 'string', 'max' => 100],
            [['nro_identificacion'], 'string', 'max' => 30],
            [['correo'], 'email'],
            [['categoria_cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientesCategorias::className(), 'targetAttribute' => ['categoria_cliente_id' => 'id']],            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre del Cliente',
            'tipo_identificacion' => 'Tipo de Identificación',
            'nro_identificacion' => 'N° de Identificación',
            'correo' => 'Correo Electrónico',
            'telefono' => 'Teléfono',
            'movil' => 'Móvil',
            'direccion' => 'Dirección',
            'credito' => 'Crédito',
            'monto_credito' => 'Monto del Crédito',
            'puntos' => 'Puntos',   
            'categoria_cliente_id' => 'Categoria del Cliente',            
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
   
    /** 
    * Gets query for [[CategoriaCliente]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getCategoriaCliente() 
    { 
       return $this->hasOne(ClientesCategorias::className(), ['id' => 'categoria_cliente_id']); 
    } 
 
    /** 
    * Gets query for [[Cotizaciones]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getCotizaciones() 
    { 
       return $this->hasMany(Cotizaciones::className(), ['cliente_id' => 'id']); 
    } 
 
    /** 
    * Gets query for [[Ventas]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getVentas() 
    { 
       return $this->hasMany(Ventas::className(), ['cliente_id' => 'id']); 
    }
}
