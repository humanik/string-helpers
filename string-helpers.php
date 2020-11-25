<?php

if (!function_exists('str_format')) {
    function str_format(string $string, array $data = []): string
    {
        return preg_replace_callback(
            '/{{\s*(?P<key>\w*)\s*}}/',
            function ($matches) use ($data) {
                return $data[$matches['key']] ?? '';
            },
            $string
        );
    }
}

if (!function_exists('str_spintax')) {
    function str_spintax(string $text): string
    {
        return preg_replace_callback(
            '/{(((?>[^{}]+)|(?R))*)}/x',
            function ($text) {
                $text = str_spintax($text[1]);
                $parts = explode('|', $text);

                return $parts[array_rand($parts)];
            },
            $text
        );
    }
}

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return mb_strpos($haystack, $needle) !== false;
    }
}

if (!function_exists('str_starts_with')) {
    function str_starts_with(string $haystack, string $needle): bool
    {
        return $needle === '' || $needle === mb_substr($haystack, 0, mb_strlen($needle));
    }
}

if (!function_exists('str_ends_with')) {
    function str_ends_with(string $haystack, string $needle): bool
    {
        return $needle === '' || $needle === mb_substr($haystack, -mb_strlen($needle));
    }
}

if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst(string $str, string $encoding = "UTF-8", bool $lower_str_end = false): string
    {
        $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
        if ($lower_str_end) {
            $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
        } else {
            $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }
        $str = $first_letter.$str_end;

        return $str;
    }
}

if (!function_exists('mb_strcasecmp')) {
    function mb_strcasecmp($str1, $str2, $encoding = null)
    {
        if (null === $encoding) {
            $encoding = mb_internal_encoding();
        }

        return strcmp(mb_strtoupper($str1, $encoding), mb_strtoupper($str2, $encoding));
    }
}
