<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "gastos".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $proveedor_id
 * @property string|null $fecha
 * @property int $tienda_id
 * @property int $forma_pago_id
 * @property float $monto
 * @property int $impuesto_id
 * @property int $gastos_categorias_id
 * @property int $gastos_subcategorias_id
 * @property int $banco_id
 * @property string $nro_referencia
 * @property string|null $nota
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Proveedores $proveedor
 * @property Tiendas $tienda
 * @property FormaPago $formaPago
 * @property Impuestos $impuesto
 * @property GastosCategorias $gastosCategorias
 * @property GastosSubcategorias $gastosSubcategorias
 * @property Bancos $banco
 */
class Gastos extends \yii\db\ActiveRecord
{   
    public $tipo_cuenta;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gastos';
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

    public function afterFind() 
    {
        parent::afterFind ();
        
        $this->fecha=Yii::$app->formatter->asDate($this->fecha);
    }          

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'proveedor_id', 'fecha', 'tienda_id', 'forma_pago_id', 'impuesto_id', 'monto'], 'required'],
            [['descripcion', 'nota'], 'string'],
            [['proveedor_id', 'tienda_id', 'forma_pago_id', 'impuesto_id', 'gastos_categorias_id', 'gastos_subcategorias_id', 'banco_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['monto'], 'number'],
            [['nro_referencia'], 'string', 'max' => 255],
            [['proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::className(), 'targetAttribute' => ['proveedor_id' => 'Id']],
            [['tienda_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tiendas::className(), 'targetAttribute' => ['tienda_id' => 'Id']],
            [['forma_pago_id'], 'exist', 'skipOnError' => true, 'targetClass' => FormaPago::className(), 'targetAttribute' => ['forma_pago_id' => 'Id']],
            [['impuesto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Impuestos::className(), 'targetAttribute' => ['impuesto_id' => 'Id']],
            [['gastos_categorias_id'], 'exist', 'skipOnError' => true, 'targetClass' => GastosCategorias::className(), 'targetAttribute' => ['gastos_categorias_id' => 'id']],
            [['gastos_subcategorias_id'], 'exist', 'skipOnError' => true, 'targetClass' => GastosSubcategorias::className(), 'targetAttribute' => ['gastos_subcategorias_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripción del Gasto',
            'proveedor_id' => 'Proveedor',
            'fecha' => 'Fecha',
            'tienda_id' => 'Tienda',
            'forma_pago_id' => 'Forma de Pago',
            'monto' => 'Monto',
            'impuesto_id' => 'Impuesto',
            'gastos_categorias_id' => 'Categoria',
            'gastos_subcategorias_id' => 'Subcategoria',
            'banco_id' => 'Banco',
            'nro_referencia' => 'N° de Referencia',
            'nota' => 'Nota',
            'status' => 'Estátus',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'tipo_cuenta' => 'Cuentas de Dinero',
        ];
    }

    /**
     * Gets query for [[Proveedor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedores::className(), ['Id' => 'proveedor_id']);
    }

    /**
     * Gets query for [[Tienda]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTienda()
    {
        return $this->hasOne(Tiendas::className(), ['Id' => 'tienda_id']);
    }

    /**
     * Gets query for [[FormaPago]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormaPago()
    {
        return $this->hasOne(FormaPago::className(), ['Id' => 'forma_pago_id']);
    }

    /**
     * Gets query for [[Impuesto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImpuesto()
    {
        return $this->hasOne(Impuestos::className(), ['Id' => 'impuesto_id']);
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

    /**
     * Gets query for [[GastosSubcategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGastosSubcategorias()
    {
        return $this->hasOne(GastosSubcategorias::className(), ['id' => 'gastos_subcategorias_id']);
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

    public static function getSubcat($id) {
        $data=\app\models\GastosSubcategorias::find()
            ->where(['gastos_categorias_id'=>$id])
            ->andWhere(['status' => 1])
            ->select(['id','subcategoria as name'])
            ->asArray()->all();
        return $data;
    }     
}
