<?php

namespace credits\Repositories;




class ImageRepo extends BaseRepo{


    protected function getModel()
    {
        // TODO: Implement getModel() method.
    }

    public function saveImages($image,$carpeta)
    {
        $file = $image;
        $prefijo = str_random(15);
        $archivo = ($file['file']['name']);
        $destino =  $carpeta.$prefijo.$archivo;
        if(move_uploaded_file($image['file']['tmp_name'], $destino))
        {
            return ($prefijo.$archivo);
        }
        return "no se pudo guardar la imagen";
    }
}