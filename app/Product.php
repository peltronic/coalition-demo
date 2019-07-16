<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Product
{
    protected static $_STOREFILE = 'store.txt';

    public static function create(array $attrs) 
    {
        if ( !Storage::disk('local')->exists(self::$_STOREFILE) ) {
            self::init();
        }

        $json = Storage::disk('local')->get(self::$_STOREFILE);
        $collection = json_decode($json);
        $now = date('Y-m-d H:i:s');
        $attrs['timestamp'] = $now;
        $collection[] = $attrs; // add the new product

        $json = json_encode($collection);
        Storage::disk('local')->put(self::$_STOREFILE, $json);

        $obj = json_decode(json_encode($json));
        return $obj;
    }

    public static function get() : array
    {
        if ( !Storage::disk('local')->exists(self::$_STOREFILE) ) {
            self::init();
        }

        $json = Storage::disk('local')->get(self::$_STOREFILE);
        $collection = json_decode($json);
        
        return $collection;
    }


    /* --- Display Helpers --- */

    public static function renderLineItemValue($obj) : string
    {
        $dollars =  $obj->price * $obj->qty / 100;
        return '$'.number_format((float)$dollars, 2, '.', '');
    }

    public static function renderTotalValue($collection) : string
    {
        $sum = 0;
        foreach ($collection as $o) {
            $sum += $o->price * $o->qty; // in cents
        }
        $dollars =  $sum / 100;
        return '$'.number_format((float)$dollars, 2, '.', '');
    }

    // Init the store file
    protected static function init() 
    {
        Storage::disk('local')->put(self::$_STOREFILE, json_encode([]));
    }


}
