<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "tiendas".
 *
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string $razon_social
 * @property string $nif_cif
 * @property string $direccion
 * @property string|null $telefono
 * @property string|null $movil
 * @property string|null $contacto
 * @property string|null $correo
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property Cajas[] $cajas
 */
class Tiendas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiendas';
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
            [['codigo', 'nombre', 'razon_social', 'direccion', 'nif_cif', 'telefono', 'movil'], 'required'],
            [['direccion'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 10],
            [['nombre', 'razon_social', 'contacto', 'correo'], 'string', 'max' => 255],
            [['nif_cif'], 'string', 'max' => 30],
            [['telefono', 'movil'], 'string', 'max' => 100],
            [['codigo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Código',
            'nombre' => 'Nombre',
            'razon_social' => 'Razón Social',
            'nif_cif' => 'NIT / RUT',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
            'movil' => 'Móvil',
            'contacto' => 'Contacto',
            'correo' => 'Correo Electrónico',
            'status' => 'Estátus',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Cajas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCajas()
    {
        return $this->hasMany(Cajas::className(), ['tienda_id' => 'id']);
    }
}
