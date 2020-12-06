<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property int $id
 * @property string $nombre
 * @property string $razon_social
 * @property string $nif_cif
 * @property string|null $contacto
 * @property string|null $correo
 * @property string|null $telefono
 * @property string|null $movil
 * @property string|null $direccion
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'razon_social', 'nif_cif', 'correo', 'telefono', 'movil', 'contacto', 'direccion'], 'required'],
            [['direccion'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'razon_social', 'contacto', 'correo'], 'string', 'max' => 255],
            [['nif_cif'], 'string', 'max' => 30],
            [['telefono', 'movil'], 'string', 'max' => 100],
            [['correo'], 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre Comercial',
            'razon_social' => 'Razón Social',
            'nif_cif' => 'NIF / CIF',
            'contacto' => 'Contacto',
            'correo' => 'Correo Electrónico',
            'telefono' => 'Teléfono',
            'movil' => 'Móvil',
            'direccion' => 'Dirección',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
