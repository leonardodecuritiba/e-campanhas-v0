<?php

namespace App\Observers\Commons;

use App\Models\Commons\Attachment;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

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