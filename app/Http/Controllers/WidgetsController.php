<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;

class WidgetsController extends Controller
{
    public function __construct()
    {
        //parent::__construct();
    }

    public function index(Request $request)
    {
        $widgets = Widget::get();
        if ( \Request::ajax() ) {
            $html = \View::make('widgets.index', [ 'widgets'=>$widgets ])->render();
        } else {
            return \View::make('widgets.index', [ 'widgets'=>$widgets ]);
        }
    }

}
