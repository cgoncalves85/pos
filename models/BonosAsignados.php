<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bonos_asignados".
 *
 * @property int $id
 * @property int $cliente_id
 * @property int $bono_id
 * @property int $nro_documento
 * @property string|null $fecha
 */
class BonosAsignados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bonos_asignados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'bono_id', 'nro_documento'], 'integer'],
            [['fecha'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cliente_id' => 'Cliente ID',
            'bono_id' => 'Bono ID',
            'nro_documento' => 'Nro Documento',
            'fecha' => 'Fecha',
        ];
    }
}
