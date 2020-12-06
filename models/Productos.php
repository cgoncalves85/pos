<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;


/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $codigo
 * @property int $categoria_id
 * @property int $medida_id
 * @property float $precio
 * @property int $impuesto_id 
 * @property string|null $imagen
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Existencias[] $existencias 
 * @property InventarioProductos[] $inventarioProductos 
 * @property OrdenProductos[] $ordenProductos  
 * @property Categorias $categoria
 * @property Medidas $medida
 * @property Impuestos $impuesto 
 * @property VentasProductos[] $ventasProductos  
 */
class Productos extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
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
            [['nombre', 'codigo', 'categoria_id', 'medida_id', 'precio', 'stock_minimo', 'stock_maximo', 'impuesto_id', 'status'], 'required'],
            [['categoria_id', 'medida_id', 'impuesto_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['precio', 'stock_minimo', 'stock_maximo'], 'number'],
            [['created_at', 'updated_at', 'image'], 'safe'],
            [['nombre', 'imagen'], 'string', 'max' => 255],
            [['codigo'], 'string', 'max' => 50],
            [['codigo'], 'unique'],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['categoria_id' => 'id']],
            [['medida_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medidas::className(), 'targetAttribute' => ['medida_id' => 'id']],
            [['impuesto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Impuestos::className(), 'targetAttribute' => ['impuesto_id' => 'id']],            
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'100000'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'codigo' => 'Código',
            'categoria_id' => 'Categoria',
            'medida_id' => 'Medida',
            'precio' => 'Precio',
            'impuesto_id' => 'Impuesto',
            'stock_minimo' => 'Stock Mínimo',
            'stock_maximo' => 'Stock Máximo',
            'imagen' => 'Imágen',
            'image' => 'Imágen',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria_id']);
    }

    /**
     * Gets query for [[Medida]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedida()
    {
        return $this->hasOne(Medidas::className(), ['id' => 'medida_id']);
    }

    public function getImageurl()
    {
        return Url::to('@web/uploads/productos/'.$this->imagen, true);
    }

    public function getImpuesto()
    {
       return $this->hasOne(Impuestos::className(), ['id' => 'impuesto_id']);
    }    

}
