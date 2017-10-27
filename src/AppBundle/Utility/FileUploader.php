<?php
/**
 * Created by PhpStorm.
 * User: farshadi
 * Date: 10/27/17
 * Time: 5:06 PM
 */

namespace AppBundle\Utility;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    const TARGET_DIR = '../src/AppBundle/Resources/upload/';

    public static function upload(UploadedFile $file, $fileName = null)
    {
        $fileName = (is_null($fileName)? md5(uniqid()) :$fileName).'.'.$file->guessExtension();
        $file->move(self::TARGET_DIR , $fileName);
        return $fileName;
    }
}