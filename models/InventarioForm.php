<?php

namespace app\models;

use app\models\Inventario;
use app\models\InventarioProductos;
use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;

class InventarioForm extends Model
{
    private $_inventario;
    private $_productos;

    
    public function rules()
    {
        return [
            [['Inventario', 'Productos'], 'required'],
            [['Productos'], 'safe'],
        ];
    }

    public function save()
    {
       if(!$this->inventario->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        if (!$this->inventario->save()) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->saveProductos()) {
            $transaction->rollBack();
            return false;
        }

        $transaction->commit();
        return true;
    }
    

    public function saveProductos()
    {
        $mantener = [];
        foreach ($this->productos as $producto) {

            $producto->inventario_id = $this->inventario->id;

            if (!$producto->save()) {
              return false;
            }
            $mantener[] = $producto->producto_id;
        }
        $query = InventarioProductos::find()->andWhere(['inventario_id' => $this->inventario->id]);
        if ($mantener) {
            //Filtrar por los productos que no estan en la lista de mantener
            $query->andWhere(['not in', 'producto_id', $mantener]);
        }

        foreach ($query->all() as $producto) {
            $producto->delete();
        }
        return true;
    }

    public function delete()
    {
        $transaction = Yii::$app->db->beginTransaction();

        if (!$this->deleteProductos()) {
            $transaction->rollBack();
            return false;
        }

        if (!$this->orden->delete()) {
            $transaction->rollBack();
            return false;
        }

        $transaction->commit();
        return true;
    }

    public function deleteProductos()
    {
        foreach ($this->productos as $producto) {
           if (!$producto->delete()) {
                return false;
            }
        }
        return true;
    }

    
    public function getInventario()
    {
        return $this->_inventario;
    }

    public function setInventario($inventario)
    {
        if ($inventario instanceof Inventario) {
            $this->_inventario = $inventario;
        } else if (is_array($inventario)) {
            $this->_inventario->setAttributes($inventario);
        }
    }

    public function getProductos()
    {
        if ($this->_productos=== null) {
            $this->_productos = $this->inventario->isNewRecord ? [] : $this->inventario->productos;
        }
        return $this->_productos;
    }

    private function getProducto($key)
    {
        $producto = $key && strpos($key, 'nuevo') === false ? InventarioProductos::findOne($key) : false;
        if (!$producto) {
            $producto = new InventarioProductos();
            $producto->loadDefaultValues();
        }
        return $producto;
    }

    public function setProductos($productos)
    {
        unset($productos['__id__']);
        $this->_productos = [];
        foreach ($productos as $key => $producto) {
            if (is_array($producto)) {
                $this->_productos[$key] = $this->getProducto($key);
                $this->_productos[$key]->setAttributes($producto);
            } elseif ($productos instanceof OrdenProductos) {
                $this->_productos[$producto->id] = $producto;
            }
        }
    }

}
