<?php
/**
* @Jentla Flexile is a fresh new template for the Joomla! Administrator Back-end.
* @copyright Copyright (C) 2010 ZacWare Pty Ltd. http://jentla.com. [^] All rights reserved.
* @license GNU/GPL, see license.txt
* Jentla Flexile is free software. you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version or open source software licenses.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*/
class gradient_image {
    var $from;
    var $to;
    var $steps;
    var $width;
    var $height;

    /**
     * gradient_image::gradient_image() - Contrutor da classe
     *
     * @param $from Cor inicial em notação hexadecimal
     * @param $to Cor final em notação hexadecimal
     * @param $steps Número de etapas do gradiente
     * @param $width Largura da imagem
     * @param $height Altura da imagem
     **/
    function gradient_image($from, $to, $steps, $width, $height)
    {
        $this->from   = $this->getHexValues($from);
        $this->to     = $this->getHexValues($to);
        $this->steps  = $steps;
        $this->width  = $width;
        $this->height = $height;
    }

    /**
     * gradient_image::getHexValues() - Cria um array com valores RGB a partir de uma cor em formato hexadecimal
     *
     * @param $color Cor em formato hexadecimal a ser convertida
     * @return array Array com os valores RGB em formato decimal
	 * @access private
     **/
    function getHexValues($color)
    {
        $color = substr($color, -6);
        return array(hexdec(substr($color, 0, 2)), hexdec(substr($color, 2, 2)), hexdec(substr($color, 4, 2)));
    }

    /**
     * gradient_image::createArray() - Cria um array com as cores do gradiente
     *
     * @return array Array com as cores do gradiente
     **/
    function createArray()
    {
        $red   = ($this->to[0] - $this->from[0]) / ($this->steps-1);
        $green = ($this->to[1] - $this->from[1]) / ($this->steps-1);
        $blue  = ($this->to[2] - $this->from[2]) / ($this->steps-1);

        for($i = 0; $i < $this->steps; $i++) {
            $newred   = $this->from[0] + round($i * $red);
            $newgreen = $this->from[1] + round($i * $green);
            $newblue  = $this->from[2] + round($i * $blue);
            $return[$i] = array($newred, $newgreen, $newblue);
        }

        return $return;
    }

    /**
     * gradient_image::createImage() - Cria uma imagem
     *
     * @param boolean $vertical Define se o gradiente será criado no sentido vertical
     * @return resource Recurso da imagem criada
     **/
    function createImage($vertical = true)
    {
        if ($vertical) {
          if ($this->steps > $this->width)  $this->steps = $this->width;
        } else {
          if ($this->steps > $this->height) $this->steps = $this->height;
        }

        $im = imagecreatetruecolor($this->width, $this->height);
        $gradient = $this->createArray();

        foreach ($gradient as $color) {
            $red   = $color[0];
            $green = $color[1];
            $blue  = $color[2];
            $colors[] = imagecolorallocate($im, $red, $green, $blue);
        }

        if ($vertical) {
            $step = $this->width / $this->steps;
            $y = $this->height;
            if ($step == 1)
                for ($x = 0, $i = 0; $x < $this->width; $x += $step, $i++)
                  imageline($im, $x, 0, $x, $y, $colors[$i]);
            else
                for ($x = 0, $i = 0; $x < $this->width; $x += $step, $i++)
                  imagefilledrectangle($im, $x, 0, $x + $step, $y, $colors[$i]);
        } else {
            $step = $this->height / $this->steps;
            $x = $this->width;
            if ($step == 1)
                for ($y = 0, $i = 0; $y < $this->height; $y += $step, $i++)
                    imageline($im, 0, $y, $x, $y, $colors[$i]);
            else
                for ($y = 0, $i = 0; $y < $this->height; $y += $step, $i++)
                    imagefilledrectangle($im, 0, $y, $x, $y + $step, $colors[$i]);
        }

        return $im;
    }

    /**
     * gradient_image::createPNG() - Cria uma imagem em formato PNG a partir do recurso de imagem especificado
     *
     * @param boolean $im Recurso de imagem a ser utilizado
     * @param boolean $interlaced Define se a imagem será entrelaçada
     * @return null
     **/
    function createPNG($im = false, $interlaced = false)
    {
        if (!$im) $im = $this->createImage();
        if ($interlaced) imageinterlace ($im, 1);
        header("Content-type: " . image_type_to_mime_type(IMAGETYPE_PNG));
        imagepng($im);
        imagedestroy($im);
    }

    /**
     * gradient_image::createJPEG() - Cria uma imagem em formato JPEG a partir do recurso de imagem especificado
     *
     * @param resource $im Recurso de imagem a ser utilizado
     * @param boolean $progressive Define se a imagem será progressiva
     * @param integer $quality Define a qualidade da imagem
     * @return null
     **/
    function createJPEG($im = false, $progressive = false, $quality = 75)
    {
        if (!$im) $im = $this->createImage();
        if ($progressive) imageinterlace ($im, 1);
        header("Content-type: " . image_type_to_mime_type(IMAGETYPE_JPEG));
        imagejpeg($im, '', $quality);
        imagedestroy($im);
    }
}
$fade_from = $_GET['fadefrom'];  // Cor inicial em notação hexadecimal
        $fade_to   = $_GET['fadeout'];  // Cor final em notação hexadecimal
        $steps     = $_GET['steps'];         // Número de etadas do gradiente
        $width     = (isset($_GET['width'])?$_GET['width']:1250);        // Largura da imagem
        $height    = $_GET['height'];        // Altura da imagem
        
        $gradient = new gradient_image($fade_from, $fade_to, $steps, $width, $height);
        $im = $gradient->createImage(false); 
        echo $gradient->createPNG($im, true);
?>
