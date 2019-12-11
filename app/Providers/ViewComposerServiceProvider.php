<?php

namespace App\Providers;

use App\Text;
use App\Traits\LocaleTrait;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class ViewComposerServiceProvider extends ServiceProvider
{
	use LocaleTrait;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    	$this->_L10N2config();
        \View::composer('*', function ($view) {
            if ($route = \Request::route()) {
                $current_route_name = $route->getName();
            } else {
                $current_route_name = null;
            }

            $view->with([
                'localizations'			=> config('translatable.names'),
                'current_route_name'	=> $current_route_name,
                'settings'				=> app('App\Settings'),
            ]);
        });

        \View::composer('public.*', function ($view) {
            $view->with([
                'texts_footer'          => $this->getTextsFooter(),
            ]);
        });
    }

    /**
     * Read footer data specific for language from DB
     * @return array texts for fooer as associative array per codename as key and translated description as value
     */
    protected function getTextsFooter()
    {
        $texts = array();
        $tmp = Text::select('texts.*')
            ->leftJoin('text_translations', 'texts.id', '=', 'text_translations.text_id')
            ->where('codename', 'LIKE', 'footer_%')
            ->where(['text_translations.locale'  => App::getLocale()])
            ->get();
        foreach ($tmp as $text)
        {
            $texts[$text->codename] = $text->description;
        }
        return $texts;
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
