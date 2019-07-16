<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Product;

class ProductModelTest extends TestCase
{
    public function test_store()
    {
        $attrs =
            [
                'pname' => 'foo',
                'qty' => 5,
                'price' => 100, // in cents
            ];
        try { 
            Product::create($attrs);
            $this->assertTrue(true, 'Other error');
        } catch (\Exception $e) {
            $this->assertTrue(false, 'Exception: '.$e->getMessage());
        }
    }
}
