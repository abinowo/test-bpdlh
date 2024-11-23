<?php

/**
 * ---------------------------------------------------- *
 *
 * @method tr
 * @summary normal translate
 * @return string
 *                ---------------------------------------------------- *
 */
if (!function_exists('tr')) {
    function tr(string $words, array $data = []): string
    {
        $prefix = config('common.prefix_trans');
        $text = collect(explode(',', $words))
            ->map(fn($word, $index) => __("{$prefix}{$word}", $index === 0 ? [] : $data))
            ->join(' ');

        return removeAllSpaces($text);
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method trFirst
 * @summary first letter translate
 * @return string
 *                ---------------------------------------------------- *
 */
if (!function_exists('trFirst')) {
    function trFirst(string $words, array $data = []): string
    {
        $prefix = config('common.prefix_trans');
        $text = collect(explode(',', $words))
            ->map(fn($word, $index) => ucfirst(__("{$prefix}{$word}", $index === 0 ? [] : $data)))
            ->join(' ');

        return removeAllSpaces($text);
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method trUc
 * @summary ucwords translate
 * @return string
 *                ---------------------------------------------------- *
 */
if (!function_exists('trUc')) {
    function trUc(string $words, array $data = []): string
    {
        $prefix = config('common.prefix_trans');
        $text = collect(explode(',', $words))
            ->map(fn($word) => ucwords(__("{$prefix}{$word}", $data)))
            ->join(' ');

        return removeAllSpaces($text);
    }
}


/**
 * ---------------------------------------------------- *
 *
 * @method trLower
 * @summary str to lower translate
 * @return string
 *                ---------------------------------------------------- *
 */
if (!function_exists('trLower')) {
    function trLower(string $words, array $data = []): string
    {
        $prefix = config('common.prefix_trans');
        $text = collect(explode(',', $words))
            ->map(fn($word) => strtolower(__("{$prefix}{$word}", $data)))
            ->join(' ');

        return removeAllSpaces($text);
    }
}

/**
 * ---------------------------------------------------- *
 * @method trUpper
 * @summary str to upper translate
 * @return string
 *                ---------------------------------------------------- *
 */
if (!function_exists('trUpper')) {
    function trUpper(string $words, array $data = []): string
    {
        $prefix = config('common.prefix_trans');
        $text = collect(explode(',', $words))
            ->map(fn($word) => strtoupper(__("{$prefix}{$word}", $data)))
            ->join(' ');

        return removeAllSpaces($text);
    }
}