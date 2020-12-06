<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "impuestos".
 *
 * @property int $id
 * @property string $descripcion
 * @property float $valor
 */
class Impuestos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'impuestos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor'], 'number'],
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
            'descripcion' => 'Descripcion',
            'valor' => 'Valor',
        ];
    }
}
