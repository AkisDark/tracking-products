<?php

namespace App\Traits;

use Exception;


trait Upload
{

    //
    public static function image($file, string $path): string
    {
        //
        if (!empty($file)) {
            //
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/' . $path, $imageName);
            //
            return $imageName;
        }
        return null;
    }
}
