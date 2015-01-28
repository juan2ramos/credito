<?php

namespace credits\Repositories;




class ImageRepo extends BaseRepo{


    protected function getModel()
    {
        // TODO: Implement getModel() method.
    }

    public function saveImages($image)
    {
        $file = $image;
        $prefijo = sha1(time());
        $archivo = ($file['file']['name']);
        $destino =  "upload/".$prefijo.$archivo;
        if(move_uploaded_file($image['file']['tmp_name'], $destino))
        {
            return ($prefijo.$archivo);
        }
        return "no se pudo guardar la imagen";
    }
}