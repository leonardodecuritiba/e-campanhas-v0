<?php

namespace App\Traits\Files;

use Illuminate\Support\Facades\File;

trait FileTrait {

	//============================================================
	//========================= FILE =============================
	//============================================================
    static public $MAIN_PATH = "storage";

	public function copyFile($new_id)
	{
		$npath = public_path($this->getPath($new_id));
		File::makeDirectory($npath, $mode = 0777, true, true);
		return File::copy( $this->link_path,  ($npath . $this->getAttribute('link')) );
	}

	public function getPath( $id = NULL)
	{
        $path = self::$MAIN_PATH . DIRECTORY_SEPARATOR . 'files'
            . DIRECTORY_SEPARATOR . self::$file_folder;

        if($id == NULL){
            if(isset(self::$field_folder) && self::$field_folder != NULL){
                $path .= DIRECTORY_SEPARATOR. $this->getAttribute( self::$field_folder );
            }
        } else {
            $path .= DIRECTORY_SEPARATOR. $id;
        }

		return $path . DIRECTORY_SEPARATOR;
	}

	public function getLinkDownloadAttribute()
	{
		return asset($this->getPath( $this->getAttribute('parent_id') ) . $this->getAttribute('link'));
	}

	public function getLinkPathAttribute()
	{
		return public_path($this->getPath( $this->getAttribute('parent_id') ) . $this->getAttribute('link'));
	}

	public function getLinkPrintAttribute()
	{
		return public_path( $this->link_path );
	}

	public function setLinkAttribute($value)
	{
		try {
			// ---------------- PATH ----------------------------
            if(!is_string($value)){
                $filename = md5(time()) .'.'. $value->getClientOriginalExtension();
                $path = public_path($this->getPath($this->getAttribute('parent_id')));
                File::makeDirectory($path, $mode = 0777, true, true);
                $value->move($path, $filename);
            } else {
                $filename = $value;
            }

			$this->attributes[ self::$field_link ] = $filename;

		} catch (\Exception $e) {
			dd($e->getMessage());
			$this->attributes[ self::$field_link ] = null;
			return false;
		}

	}

}