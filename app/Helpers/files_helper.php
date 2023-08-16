<?php

function subirArchivo($archivo) {

    try {

        // renombrar el archivo
        $ext = $archivo->guessExtension();
        $time = time();
        $filename = "$time.$ext";

        // ruta a la que se movera
        $ruta = ROOTPATH . 'public/uploads';
        $url = base_url();

        // mover el archivo
        if ($archivo->move($ruta, $filename)) {
            $url .= '/uploads/' . $filename;

            return $url;
        }

        return null;

    } catch (\Exception $e) {
        throw $e;
    }

}

function eliminarArchivo($url) {

    try {

        $ruta = ROOTPATH . 'public';
        $file = str_replace(base_url(), '', $url);

        $path = "$ruta" . "$file";

        if (file_exists($path)) {
            unlink($path);
        }

    } catch (\Exception $e) {
        throw $e;
    }

}