<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\bootstrap4\ActiveForm;
use app\models\LibroPrecios;
use app\models\LibroPreciosProductos;

class LibroPreciosForm extends Model
{
    private $_libro;
    private $_productos;

    
    public function rules()
    {
        return [
            [['LibroPrecios', 'Productos'], 'required'],
            [['Productos'], 'safe'],
        ];
    }

    public function save()
    {
       if(!$this->libroPrecios->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        if (!$this->libroPrecios->save()) {
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

            $producto->libro_precio_id = $this->libroPrecios->id;

            if (!$producto->save()) {
              return false;
            }
            $mantener[] = $producto->producto_id;
        }
        $query = LibroPreciosProductos::find()->andWhere(['libro_precio_id' => $this->libroPrecios->id]);
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

        if (!$this->cotizaciones->delete()) {
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

    
    public function getLibroPrecios()
    {
        return $this->_libro;
    }

    public function setLibroPrecios($libro)
    {
        if ($libro instanceof LibroPrecios) {
            $this->_libro = $libro;
        } else if (is_array($libro)) {
            $this->_libro->setAttributes($libro);
        }
    }

    public function getProductos()
    {
        if ($this->_productos=== null) {
            $this->_productos = $this->libroPrecios->isNewRecord ? [] : $this->libroPrecios->productos;
        }
        return $this->_productos;
    }

    private function getProducto($key)
    {
        $producto = $key && strpos($key, 'nuevo') === false ? LibroPreciosProductos::findOne($key) : false;
        if (!$producto) {
            $producto = new LibroPreciosProductos();
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
            } elseif ($productos instanceof LibroPreciosProductos) {
                $this->_productos[$producto->id] = $producto;
            }
        }
    }

}
