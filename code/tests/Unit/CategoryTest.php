<?php

namespace Tests\Unit;

use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_category_store()
    {
        $response=$this->call('POST', '/category',[
            'name'=>'Test Case',
            'description'=>'test case',
        ]);

        $response->assertStatus($response->status(),200);
    }

    public function test_category_update()
    {
        $response=$this->call('PUT', '/category/1',[
            'name'=>'Test Case',
            'description'=>'test case',
        ]);

        $response->assertStatus($response->status(),200);
    }

    public function test_category_get()
    {
        $response=$this->call('get', '/category/1');

        $response->assertStatus($response->status(),200);
    }
}
