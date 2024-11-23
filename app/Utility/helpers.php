<?php

/**
 * ---------------------------------------------------- *
 *
 * @method alertShow
 *
 * @param  string  $name
 * @return string
 *
 * @summary field validation when page receiving response
 * ---------------------------------------------------- *
 */
if (!function_exists('alertShow')) {
    function alertShow($data = [])
    {
        $isSuccess = isset($data['success']);
        $isFailed = isset($data['failed']);
        if ($isSuccess) {
            echo '<div class="alert alert-success bg-white">
                    ' . $data['success'] . '
                </div>';
        } elseif ($isFailed) {
            echo '<div class="alert alert-danger bg-white">
                    ' . $data['failed'] . '
                </div>';
        }
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method remove all "extra" blank space from the given string.
 *
 * @param  string  $value
 * @return string
 *                ---------------------------------------------------- *
 */
if (!function_exists('removeAllSpaces')) {
    function removeAllSpaces($text)
    {
        $finalText = str_replace([':label', ':message'], '', $text);

        return preg_replace('~(\s|\x{3164}|\x{1160})+~u', ' ', preg_replace('~^[\s\x{FEFF}]+|[\s\x{FEFF}]+$~u', '', $finalText));
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method save json encode
 *
 * @param  string  $value
 * @return string
 *                ---------------------------------------------------- *
 */
if (!function_exists('jsonSafeEncode')) {
    function jsonSafeEncode($value)
    {
        try {
            return json_encode($value);
        } catch (\Exception $e) {
            return null;
        }
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method save json decode
 *
 * @param  string  $value
 * @return string
 *                ---------------------------------------------------- *
 */
if (!function_exists('jsonSafeDecode')) {
    function jsonSafeDecode($value)
    {
        try {
            $decode = json_decode($value);
            if (gettype($decode) === 'string') {
                $decode = json_decode($decode);
            }

            return $decode;
        } catch (\Exception $e) {
            return null;
        }
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method on delete directory and files
 *
 * @param  string  $value
 * @return string
 *                ---------------------------------------------------- *
 */
if (!function_exists('onDeleteDirectoryAndFiles')) {
    function onDeleteDirectoryAndFiles($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!onDeleteDirectoryAndFiles($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }
}

/**
 * [helper] get number format format for currency
 *
 * @return null
 */
if (!function_exists('nf')) {
    function nf($value, $opts = [])
    {
        $comma = 0;
        $currency = 'IDR';
        if (is_numeric($value)) {
            $number = $value === '' ? 0 : str_replace(',', '', $value);
            if (isset($opts['useCurrency'])) {
                return $currency . ' ' . number_format($number, $comma, '.', ',');
            }

            return number_format($number, $comma, '.', ',');
        }

        return number_format($value ?? 0);
    }
}

/**
 * [helper] remove number format for currency
 *
 * @return string
 */
if (!function_exists('nfr')) {
    function nfr($value)
    {
        return floatval(str_replace(',', '', $value));
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method getId
 *
 * @return string
 *
 * @uses to generate id with format {date}@{randomstring}
 * ---------------------------------------------------- *
 */
if (!function_exists('getId')) {
    function getId()
    {
        return date('YmdHis') . '@' . strtoupper(\Illuminate\Support\Str::random(10));
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method get increment id
 *
 * @return string
 *
 * @uses get increment id with spesific table
 * ---------------------------------------------------- *
 */
if (!function_exists('addJsonData')) {
    function addJsonData($params)
    {
        $oldData = $params['old_data'] ?? [];
        $newData = $params['new_data'] ?? [];
        $oldType = gettype($oldData);
        $newType = gettype($newData);
        $newData = $newData ?? json_encode([]);

        switch ($oldType) {
            case 'string':
                $oldData = json_decode($oldData);
                break;
            case 'array':
                $oldData = json_decode(json_encode($oldData));
                break;
        }

        switch ($newType) {
            case 'string':
                $newData = json_decode($newData);
                break;
            case 'array':
                $newData = json_decode(json_encode($newData));
                break;
        }

        // if its object convert it into array
        if (gettype($oldData) === 'object') {
            $oldData = (array) $oldData;
        }
        if (gettype($newData) === 'object') {
            $newData = (array) $newData;
        }

        $mergeData = [];
        if (isset($oldData) && !isset($newData)) {
            $mergeData = $oldData;
        } elseif (!isset($oldData) && isset($newData)) {
            $mergeData = $newData;
        } else {
            $mergeData = array_merge($oldData, $newData);
        }

        return json_encode($mergeData);
    }
}
