<?php

use App\Models\Media;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * ---------------------------------------------------- *
 *
 * @method getFileUrls
 *
 * @return array
 *
 * @uses to calculate only getFileUrls
 * ---------------------------------------------------- *
 */
if (! function_exists('getFileUrls')) {
    function getFileUrls($fileName)
    {
        $year = date('Y');

        return [
            'large' => "{base_url}/storage/uploads/{$year}/large/{$fileName}",
            'medium' => "{base_url}/storage/uploads/{$year}/medium/{$fileName}",
            'small' => "{base_url}/storage/uploads/{$year}/small/{$fileName}",
            'thumb' => "{base_url}/storage/uploads/{$year}/thumb/{$fileName}",
        ];
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method getPartials
 *
 * @return array
 *
 * @uses to calculate only getPartials
 * ---------------------------------------------------- *
 */
if (! function_exists('getPartials')) {
    function getPartials($fileName)
    {
        return [
            'large' => "large/{$fileName}",
            'medium' => "medium/{$fileName}",
            'small' => "small/{$fileName}",
            'thumb' => "thumb/{$fileName}",
        ];
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method getFilePaths
 *
 * @return array
 *
 * @uses to calculate only getFilePaths
 * ---------------------------------------------------- *
 */
if (! function_exists('getFilePaths')) {
    function getFilePaths($fileName)
    {
        $year = date('Y');

        return [
            'large' => storage_path("app/public/uploads/{$year}/large/{$fileName}"),
            'medium' => storage_path("app/public/uploads/{$year}/medium/{$fileName}"),
            'small' => storage_path("app/public/uploads/{$year}/small/{$fileName}"),
            'thumb' => storage_path("app/public/uploads/{$year}/thumb/{$fileName}"),
        ];
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method base64ToImage
 *
 * @return file
 *
 * @uses to calculate only base64ToImage
 * ---------------------------------------------------- *
 */
if (! function_exists('base64ToImage')) {
    function base64ToImage($base64String)
    {
        $data = explode(',', $base64String);
        $imageData = base64_decode($data[1]);
        $tempFilePath = tempnam(sys_get_temp_dir(), 'image');
        file_put_contents($tempFilePath, $imageData);

        return $tempFilePath;
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method onSaveImage
 *
 * @return file
 *
 * @uses to calculate only onSaveImage
 * ---------------------------------------------------- *
 */
if (! function_exists('onSaveImage')) {
    function onSaveImage($params)
    {
        $manager = new ImageManager(new Driver);
        $file = $params['file'];
        $fileName = $params['file_name'];
        $path = $params['file_path'];
        $width = $params['file_width'];
        $height = $params['file_height'];
        $image = $manager->read($file);
        $image->scale($width, $height);
        $fullPath = storage_path('app/'.$path);
        if (! file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }
        $image->save($fullPath.'/'.$fileName);
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method onSaveImageBreakpoints
 *
 * @return file
 *
 * @uses to calculate only onSaveImageBreakpoints
 * ---------------------------------------------------- *
 */
if (! function_exists('onSaveImageBreakpoints')) {
    function onSaveImageBreakpoints($params)
    {
        $file = $params['file'] ?? null;
        $mediaId = $params['media_id'] ?? null;
        $action = $params['action'] ?? null;
        $meta = $params['meta'] ?? null;
        $isEdit = $action === 'edit';

        if (is_null($file)) {
            return null;
        }

        $year = date('Y');
        $path = "public/uploads/{$year}/";
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = $params['file_name'].'.'.$file->getClientOriginalExtension();
        $type = in_array($fileExtension, ['png', 'jpeg', 'jpg', 'webp', 'svg']) ? 'image' : 'document';
        $isImage = $type === 'image';

        if ($isEdit) {
            $media = Media::where('id', $mediaId)->first();
            if (! is_null($media)) {
                $mediaFiles = jsonSafeDecode($media->file_path);
                onDeleteImages(['file' => $mediaFiles]);
            }
        }

        if ($isImage) {
            // large
            onSaveImage([
                'file' => $file,
                'file_name' => $fileName,
                'file_path' => $path.'/large',
                'file_width' => 1920,
                'file_height' => 1080,
            ]);
            // medium
            onSaveImage([
                'file' => $file,
                'file_name' => $fileName,
                'file_path' => $path.'/medium',
                'file_width' => 1280,
                'file_height' => 720,
            ]);
            // small
            onSaveImage([
                'file' => $file,
                'file_name' => $fileName,
                'file_path' => $path.'/small',
                'file_width' => 640,
                'file_height' => 360,
            ]);
            // thumb
            onSaveImage([
                'file' => $file,
                'file_name' => $fileName,
                'file_path' => $path.'/thumb',
                'file_width' => 250,
                'file_height' => 250,
            ]);
        } else {
            // if not images
        }

        $media = null;
        $data = [
            'file_name' => $fileName,
            'file_path' => json_encode(getFilePaths($fileName)),
            'file_url' => json_encode(getFileUrls($fileName)),
            'extension' => $fileExtension,
            'alt' => null,
            'caption' => null,
            'type' => $type,
            'partials' => json_encode(getPartials($fileName)),
            'meta' => $meta,
        ];
        if (! is_null($mediaId)) {
            Media::where('id', $mediaId)->update($data);
            $media = Media::find($mediaId);
        } else {
            $media = Media::create(array_merge($data, [
                'id' => getId(),
            ]));
        }

        return $media;
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method onDeleteImages
 *
 * @return file
 *
 * @uses to calculate only onDeleteImage
 * ---------------------------------------------------- *
 */
if (! function_exists('onDeleteImages')) {
    function onDeleteImages($params)
    {
        $files = $params['file'];
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method onRequestFile
 *
 * @return file
 *
 * @uses to calculate only onRequestFile
 * ---------------------------------------------------- *
 */
if (! function_exists('onRequestFile')) {
    function onRequestFile($request)
    {
        if ($request->file === 'string') {
            $fileData = $request->input('base64');
            $tempFilePath = base64ToImage($fileData);
            $file = new \SplFileInfo($tempFilePath);
            $file->extension = 'png'; // Adjust this based on the actual image type

            return $file;
        } elseif ($request->hasFile('file')) {
            return $request->file('file');
        }

        return null;
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method onMediaResponse
 *
 * @return array
 *
 * @uses to calculate only onMediaResponse
 * ---------------------------------------------------- *
 */
if (! function_exists('onMediaResponse')) {
    function onMediaResponse($meta)
    {
        $mediaId = null;
        if (! is_null($meta)) {
            $itemMeta = jsonSafeDecode($meta);
            $mediaId = isset($itemMeta->media_id) ? $itemMeta->media_id : null;
        }
        if (is_null($mediaId)) {
            return null;
        }

        $media = Media::find($mediaId);
        $mediaUrls = jsonSafeDecode($media->file_url ?? null);
        $dataUrls = [];
        if (is_null($mediaUrls)) {
            return null;
        }
        foreach ($mediaUrls as $mediaUrlKey => $mediaUrl) {
            $dataUrls[$mediaUrlKey] = str_replace('{base_url}', \URL::to('/'), $mediaUrl);
        }

        return [
            'id' => $media->id,
            'type' => $media->type,
            'extension' => $media->extension,
            'file_url' => $dataUrls,
        ];
    }
}

/**
 * ---------------------------------------------------- *
 *
 * @method getMediaImage
 *
 * @return array
 *
 * @uses to calculate only getMediaImage
 * ---------------------------------------------------- *
 */
if (! function_exists('getMediaImage')) {
    function getMediaImage($params)
    {
        $meta = jsonSafeDecode($params['meta']) ?? null;
        $size = $params['size'] ?? 'lg';
        $mediaId = $meta->media_id ?? null;
        if (is_null($mediaId)) {
            return null;
        }

        $media = Media::find($mediaId);
        $mediaUrls = jsonSafeDecode($media->file_url ?? null);
        $dataUrls = [];
        if (is_null($mediaUrls)) {
            return null;
        }
        foreach ($mediaUrls as $mediaUrlKey => $mediaUrl) {
            $dataUrls[$mediaUrlKey] = str_replace('{base_url}', \URL::to('/'), $mediaUrl);
        }

        switch ($size) {
            case 'sm':
            case 'md':
                return $dataUrls['medium'];
            case 'lg':
                return $dataUrls['large'];
            case 'tb':
                return $dataUrls['thumb'];
            default:
                return $dataUrls['small'];
        }
    }
}
