<?php

namespace app;

class Utils
{
    /**
     * Function to check is a html message.
     *
     * @param string $content
     *
     * @return bool
     */
    public static function isHtml(string $content): bool
    {
        $content = trim($content);

        if ('<' === substr($content, 0, 1) && '>' === substr($content, -1)) {
            return true;
        }

        return $content != strip_tags($content);
    }
}