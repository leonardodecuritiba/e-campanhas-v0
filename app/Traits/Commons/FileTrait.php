<?php

namespace App\Traits\Commons;

use Illuminate\Support\Facades\File;

trait FileTrait {
    /**
     * Get path to store files
     * @return int
     */
    public function getIdFileAttribute(): int
    {
        return (self::$file_mode == 'self') ? $this->getAttribute('id') : $this->getAttribute(self::$field_parent_id);
    }

    /**
     * Get path to store files
     * @param int|null $id
     * @return string
     */
    public function getPath(int $id = NULL): string
    {
        $path = self::$file_folder;

        if($id == NULL){
            if(isset(self::$file_subfolder) && self::$file_subfolder != NULL){
                $path .= DIRECTORY_SEPARATOR. $this->getAttribute( self::$file_subfolder );
            }
        } else {
            $path .= DIRECTORY_SEPARATOR. $id;
        }

        return $path;
    }

    public function getRealPathAttribute()
    {
        $id = null;//$this->getIdFileAttribute();
        return storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $this->getPath( $id ) . $this->getAttribute( self::$field_filename ));
    }

    public function getLinkPathAttribute()
    {
        $id = null;//$this->getIdFileAttribute();
        return public_path($this->getPath( $id ) . $this->getAttribute( self::$field_filename ));
    }

    public function getLinkDownloadAttribute()
    {
        $id = null;//$this->getIdFileAttribute();
        return asset('storage' . DIRECTORY_SEPARATOR . $this->getPath( $id ) . DIRECTORY_SEPARATOR . $this->getAttribute( self::$field_filename ));
    }

    public function getImageViewAttribute()
    {
        $id = null;//$this->getIdFileAttribute();
        $image = $this->getAttribute( self::$field_filename );
        if($image != NULL){
            return asset('storage' . DIRECTORY_SEPARATOR . $this->getPath( $id ) . DIRECTORY_SEPARATOR . $image);
        }
        return asset('assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR . 'default.jpg');
    }

	public function getLinkPrintAttribute()
	{
		return public_path( $this->link_path );
	}

	public function setFileAttribute($file)
	{
		try {
			// ---------------- PATH ----------------------------
//            dd($file);
            if(!is_string($file) && $file != NULL){
                $filename = md5(time()) .'.'. $file->getClientOriginalExtension();
                // Armazenar a imagem no diretório dentro de storage/app/public
                $id = null;//$this->getIdFileAttribute();
                $path = $this->getPath( $id );
                $path = $file->storeAs($path, $filename, 'public');
            } else {
                $filename = $file;
            }

			$this->attributes[ self::$field_filename ] = $filename;
            return $filename;

		} catch (\Exception $e) {
//			dd($e->getMessage());
			$this->attributes[ self::$field_filename ] = null;
			return false;
		}
	}


//    public function copyFile($new_id): bool
//    {
//        $new_pathname = public_path($this->getPath($new_id));
//        File::makeDirectory($new_pathname, $mode = 0777, true, true);
//        return File::copy( $this->link_path,  ($new_pathname . $this->getAttribute( self::$field_filename )) );
//    }
}