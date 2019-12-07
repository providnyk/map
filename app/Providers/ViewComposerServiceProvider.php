<?php

namespace App\Providers;

use App\Festival;
use App\Text;
use App\Partner;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class ViewComposerServiceProvider extends ServiceProvider
{
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
                'localizations' => config('translatable.names'),
                'current_route_name' => $current_route_name,
            ]);
        });

        \View::composer('public.*', function ($view) {
//           $festivals = Festival::orderBy('active', 'desc')->get();
//
//            dd($festivals);
//
//            if ($festivals->isNotEmpty()) {
//                $festival = $festivals->pull($festivals->search(function($festival) {
//                    $festival_slug = request()->festival_slug;
//
//                    if ($festival_slug) {
//                        return $festival->slug == $festival_slug;
//                    }
//
//                    return $festival->active == 1;
//                }));
//            } else {
//                $festival = new \App\Festival;
//            }
#                'promoting_partners' => Festival::getPromotingPartners(),

            $view->with([
                //'festivals' => $festivals,
                //'festival' => $festival,
                #'promoting_partners' => Partner::promoting()->inRandomOrder()->take(4)->get(),
                'texts_footer'          => $this->getTextsFooter(),
                'settings'              => app('App\Settings')
            ]);
        });

        \View::composer(['public.partials.events-list', 'public.profile.my-cs', 'public.press.list'], function ($view) {

//            $festivals = \App\Festival::all();
//
//            if ($festivals->isNotEmpty()) {
//                $festival = $festivals->pull($festivals->search(function($festival) {
//                    $festival_slug = request()->festival_slug;
//
//                    if ($festival_slug) {
//                        return $festival->slug == $festival_slug;
//                    }
//
//                    return $festival->active == 1;
//                }));
//
//                $holding_dates = [
//                    'min' => $festival->holdings()->min('date_from'),
//                    'max' => $festival->holdings()->max('date_from')
//                ];
//            } else {
//                $festival = new \App\Festival;
//
//                $holding_dates = [
//                    'min' => null,
//                    'max' => null
//                ];
//            }

            //dd($festival->current()->toArray());

            $this->_setCategoriesToView($view, 'events');

        });

        \View::composer(['public.press.list'], function ($view) {
            $this->_setCategoriesToView($view, 'presses');
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
    * Send categories and their translations directly to the view
    *
    * @param view $view current view
    * @param String $s_cat_type category slug
    *
    * @return void
    */
    private function _setCategoriesToView($view, $s_cat_type) {
        $categories = DB::table('categories as c')
            ->select('c.*', 'ct.name', 'ct.slug')
            ->join('category_translations as ct', 'c.id', '=', 'ct.category_id')
            ->where([
                'ct.locale' => app()->getLocale(),
                'c.type'    => $s_cat_type
            ])
            ->groupBy('c.id')
            ->orderBy('ct.name');

        $view->with([
            $s_cat_type . '_categories' => $categories->get()
        ]);
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

	private function _L10N2config()
	{
		$s_path = base_path().'/resources/lang';
		$a_files = File::directories($s_path);
		$a_files = File::allFiles($s_path);
		$a_dirs = [];
		$a_L10N = [];

		foreach ($a_files as $o_file)
		{
			$s_abbr = $o_file->getRelativePath();
			if (strlen($s_abbr) != 2)
				$s_abbr = '';
			if (!empty($s_abbr))
			{
				if ($o_file->getFilename() == 'app.php')
				{
				$a_tmp = include($o_file->getPathname());
				if (isset($a_tmp['lang']['this']))
					$a_dirs[$s_abbr] = $a_tmp['lang']['this'];
				}
				if(!isset($a_dirs[$s_abbr]))
					$a_dirs[$s_abbr] = NULL;
			}
		}

		foreach ($a_dirs as $s_abbr => $s_name)
		{
			if (app()->getLocale() == $s_abbr)
				$a_L10N[$s_abbr] = trans('app.lang.this');
			elseif (trans('app.lang.'.$s_abbr) != 'app.lang.'.$s_abbr)
				$a_L10N[$s_abbr] = trans('app.lang.'.$s_abbr);
			elseif (!is_null($a_dirs[$s_abbr]))
				$a_L10N[$s_abbr] = $a_dirs[$s_abbr];
			else
				$a_L10N[$s_abbr] = mb_strtoupper($s_abbr);
		}

		config(['translatable' => [
					'locales' => array_keys($a_L10N),
					'names' => $a_L10N,
				]]);
/**/
	}
}
