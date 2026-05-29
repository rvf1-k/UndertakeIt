<?php
class UploadHelper
{
    public static function processImage(array $image): string
    {
        self::validateUpload($image);

        self::validateMimeType($image);

        self::validateImageSize($image);

        $fileName = self::generateFileName($image);

        return self::moveImage($image, $fileName);
    }

    private static function validateUpload(array $image): void
    {
        if ($image['error'] !== UPLOAD_ERR_OK) {
            die("Error al subir archivo");
        }
    }

    private static function validateMimeType(array $image): void
    {
        $allowed = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        $mime = finfo_file($finfo, $image['tmp_name']);

        if (!in_array($mime, $allowed)) {
            die("Formato no permitido");
        }
    }

    private static function validateImageSize(array $image): void
    {
        $maxSize = 5 * 1024 * 1024;

        if ($image['size'] > $maxSize) {
            die("Imagen demasiado grande");
        }
    }

    private static function generateFileName(array $image): string
    {
        $extension = pathinfo(
            $image['name'],
            PATHINFO_EXTENSION
        );

        return uniqid('task_', true) . '.' . $extension;
    }

    private static function moveImage(
        array $image,
        string $fileName
    ): string {

        $path = '/uploads/tasks/' . $fileName;

        $destination =
            __DIR__
            . '/../../public'
            . $path;

        move_uploaded_file(
            $image['tmp_name'],
            $destination
        );

        return $path;
    }
}
