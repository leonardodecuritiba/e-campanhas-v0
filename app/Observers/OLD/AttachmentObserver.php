<?php

namespace App\Observers\OLD;

use App\Models\Commons\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AttachmentObserver {
	protected $request;

	public function __construct( Request $request ) {
		$this->request = $request;
	}


	/**
	 * Listen to the Work creating event.
	 *
	 * @param Attachment $attachment
	 *
	 * @return void
	 */
	public function creating( Attachment $attachment )
	{
	}

	/**
	 * Listen to the WorkFile creating event.
	 *
	 * @param Attachment $attachment
	 *
	 * @return void
	 */
	public function deleting( Attachment $attachment )
	{
		File::Delete($attachment->link_path);

		$path = $attachment->getPath($attachment->parent_id);
		// Check if directory is empty.
		if (empty(File::files($path))) {
			// Yes, delete the directory.
			File::deleteDirectory($path);
		}

	}


}