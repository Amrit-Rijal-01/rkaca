<?php

namespace App;

class Helper
{
    public static function putCache($_filePath, $content)
    {
        $pathParts = explode('.', $_filePath);
        // append .blade.php to last element if not exists
        if (count($pathParts) > 0) {
            $lastElement = $pathParts[count($pathParts) - 1];
            if (substr($lastElement, -10) !== '.blade.php') {
                $pathParts[count($pathParts) - 1] .= '.blade.php';
            }
        }

        $filePath = implode('/', $pathParts);

        $filePath = resource_path('views/front/cache/'.$filePath);
        // Extract the directory path from the file path
        $directoryPath = dirname($filePath);

        // Ensure the directory exists, if not create it
        if (! is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        // Put the content to the file path
        file_put_contents($filePath, $content);
    }
}
