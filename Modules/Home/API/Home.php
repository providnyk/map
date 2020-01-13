<?php

namespace Modules\Home\API;

use Modules\Home\Database\Home as Model;

class Home extends Model
{
	public $translationModel = '\Modules\Home\Database\HomeTranslation';
}
