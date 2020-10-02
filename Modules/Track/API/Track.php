<?php

namespace Modules\Track\API;

use Modules\Track\Database\Track as Model;

class Track extends Model
{
	public $translationModel = '\Modules\Track\Database\TrackTranslation';
}
