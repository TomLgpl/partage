<?php
declare(strict_types=1);

namespace App\Utility;

use Cake\Http\Session\DatabaseSession;

class Resizer
{
    public static function resizeImage($name, $jour, $mois, $annee, $dossier)
    {
        $filePath = WWW_ROOT . 'img' . DS . 'upload' . DS . $annee . DS . $mois . DS . $jour . DS . $dossier . DS . $name;
        [$width, $height, $type] = getimagesize($filePath);

        $multiple = 500 / ($width > $height ? $width : $height);
        $new_width = intval($width * $multiple);
        $new_height = intval($height * $multiple);
        $image_p = imagecreatetruecolor($new_width, $new_height);

        if($type == IMAGETYPE_JPEG){
            $image = imagecreatefromjpeg($filePath);
        }
        if($type == IMAGETYPE_PNG){
            $image = imagecreatefrompng($filePath);
        }

        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        $targetPath = WWW_ROOT . 'img' . DS . 'miniatures';
        if (!is_dir($targetPath)) {
            mkdir($targetPath);
        }
        $targetPath .= DS . $annee;
        if (!is_dir($targetPath)) {
            mkdir($targetPath);
        }
        $targetPath .= DS . $mois;
        if (!is_dir($targetPath)) {
            mkdir($targetPath);
        }
        $targetPath .= DS . $jour;
        if (!is_dir($targetPath)) {
            mkdir($targetPath);
        }
        $targetPath .= DS . $dossier;
        if (!is_dir($targetPath)) {
            mkdir($targetPath);
        }
        $targetPath .= DS . $name;

        if($type == IMAGETYPE_JPEG) {
            imagejpeg($image_p, $targetPath);
        }
        if($type == IMAGETYPE_PNG){
            imagepng($image_p, $targetPath);
        }
    }
}
