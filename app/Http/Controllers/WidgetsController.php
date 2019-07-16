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
        return \View::make('widgets.index', [ 'widgets'=>$widgets ]);
    }

}
