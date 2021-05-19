<?php
class util_functions
{

    public static function resultado_humanizado($resultado)
    {
        if ($resultado == true) {
            return "Realizado correctamente";
        } else {
            return "Error al realizarlo";
        }
    }

    public static function fecha_to_sql($cadena)
    {
        $fecha_sql = explode("-", $cadena);
        return $fecha_sql[2] . "-" . $fecha_sql[1] . "-" . $fecha_sql[0];
    }


    public static function is_estado_validate($cadena)
    {
        if ($cadena == "1" || $cadena == "0") {
            return 1;
        } else {
            return 0;
        }
    }

    public static function generateNamePdfX()
    {
        return self::generateRandomString().microtime(TRUE);
    }

    private static function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function is_numero_validate($cadena)
    {
        return is_numeric($cadena);
    }

    public static function is_cadena_validate($candena)
    {
        return is_string($candena);
    }

    public static function is_precio_validate($cadena)
    {
        $validador = 0;
        for ($i = 0; $i < strlen($cadena); $i++) {
            if ($cadena[$i] == ",") {
                $validador += 1;
            }
        }

        if ($validador > 1) {
            $validador = 0;
        }

        return $validador;
    }

    public static function is_date_validate($cadena)
    {
        $validador = 0;
        for ($i = 0; $i < strlen($cadena); $i++) {
            if ($cadena[$i] == "-") {
                $validador += 1;
            }
        }

        if ($validador == 2) {
            $validador = 1;
        } else {
            $validador = 0;
        }

        return $validador;
    }

    public static function rutaPdfPresupuestoX()
    {
        return "assets/upload/presu/";
    }

    public static function rutaPdfGastoX()
    {
        return "assets/upload/gasto/";
    }

    public static function rutaRespaldoImagen()
    {
        return "assets/upload/producto_eli/";
    }

    public static function rutaImagenRepoMinificada()
    {
        return "assets/upload/producto/";
    }

    public static function rutaTexturaRepoMinificada()
    {
        //return "assets/upload/textura_eli/";
        return "assets/upload/textura/";
    }

    public static function existeLaImagen($ruta_imagen)
    {
        if (file_exists($ruta_imagen)) {
            return true;
        } else {
            return false;
        }
    }

    public static function extensionImgPermitida($extension)
    {
        if (
            $extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "JPG" || $extension == "PNG" ||
            $extension == "GIF" || $extension == "bmp" || $extension == "BMP" || $extension == "JPEG" || $extension == "jpeg"
        ) {
            return true;
        } else {
            return false;
        }
    }

    public static function extensionPdfPermitidaX($extension)
    {
        if (
            $extension == "pdf" || $extension == "PDF"
        ) {

            return true;
        } else {
            return false;
        }
    }

    public static function tamanioPdfPermitidaX($tamanio)
    {
        if ($tamanio < 9000000000000) {
            return true;
        } else {
            return false;
        }
    }

    public static function tamanioImgPermitida($tamanio)
    {
        if ($tamanio < 9000000000000) {
            return true;
        } else {
            return false;
        }
    }

    public static function mi_utf8ize($d)
    {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = self::mi_utf8ize($v);
            }
        } else if (is_string($d)) {
            return utf8_encode($d);
        }
        return $d;
    }

    public static function mi_utf8ize_2($d)
    {
        if (is_array($d))
            foreach ($d as $k => $v)
                $d[$k] = self::mi_utf8ize_2($v);

        else if (is_object($d))
            foreach ($d as $k => $v)
                $d->$k = self::mi_utf8ize_2($v);

        else
            return utf8_encode($d);

        return $d;
    }

    public static function cleanInput($input)
    {
        $search = array(
            '@<script[^>]*?>.*?</script>@si',   // Elimina javascript
            '@<[\/\!]*?[^<>]*?>@si',            // Elimina las etiquetas HTML
            '@<style[^>]*?>.*?</style>@siU',    // Elimina las etiquetas de estilo
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Elimina los comentarios multi-línea
        );

        $output = preg_replace($search, '', $input);
        return $output;
    }

    public static function cleanSpecialChars($texto)
    {
        $texto = str_replace(array("\\", "°", "ª", "|", "'", "[", "]", "{", "}", "Â°", "~", "*", "¬", "€", "=", "_", "<", "¨", "Ç", "¿", "?", "·", "º", "€", "¬", "Ç", "´", "“", "”"), " ", $texto);

        $texto = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä', "Ã¡",),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'a',),
            $texto
        );

        $texto = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë', "Ã©", "Ã‰"),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', "e", "E"),
            $texto
        );


        $texto = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î', "Ã­ i", "Ã"),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I', "i", "I"),
            $texto
        );

        $texto = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô', "Ã³", "Ã“"),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', "o", "O"),
            $texto
        );

        $texto = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü', "Ãº", "Ã¼"),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', "u", "U"),
            $texto
        );

        $texto = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç', "Ã±", "Ã‘"),
            array('n', 'N', 'c', 'C', "n", "N"),
            $texto
        );

        $texto = str_replace(
            array(
                "\\", "¨", "º", "-", "~",
                "#", "@", "|", "!", "\"",
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", "¡",
                "¿", "[", "^", "`", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                "."
            ),
            '',
            $texto
        );

        return $texto;
    }


    public static function urls_amigables($url)
    {
        $url = strtolower($url);
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
        $repl = array('a', 'e', 'i', 'o', 'u', 'n');

        $url = str_replace($find, $repl, $url);

        $find = array(' ', '&', '\r\n', '\n', '+');
        $url = str_replace($find, '-', $url);

        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

        $repl = array('', '-', '');

        $url = preg_replace($find, $repl, $url);

        return $url;
    }
}
