<?php

namespace Modules\Opinion\API;

use Modules\Opinion\Database\Opinion as Model;

class Opinion extends Model
{
	public $translationModel = '\Modules\Opinion\Database\OpinionTranslation';
}
