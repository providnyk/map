<?php

namespace Modules\Welcome\API;

use Modules\Welcome\Database\Welcome as Model;

class Welcome extends Model
{
	public $translationModel = '\Modules\Welcome\Database\WelcomeTranslation';
}
