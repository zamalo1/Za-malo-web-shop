<?php


namespace App\Utils;


class IncludeTemplate
{
    public static function includeTemplateFile($file,$templateArray=[])
    {
        if (!file_exists(__DIR__ . "/../Templates/" . $file)) {
            return "";
        }
        ob_start();
        include __DIR__ . "/../Templates/" . $file;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}