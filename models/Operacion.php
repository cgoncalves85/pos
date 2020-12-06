<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operacion".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion 
 */
class Operacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 64],
            [['descripcion'], 'string', 'max' => 255], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Ruta',
            'descripcion' => 'Descripción del Permiso', 
        ];
    }
}
