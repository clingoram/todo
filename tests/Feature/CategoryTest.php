<?php

/**
 * php artisan test
 */

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    // 每次測試完後，清空DB
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Insert test
     */
    // public function test_insert()
    // {
    //     $response = $this->post('api/items/categories');

    //     $response->assertStatus(200); //確認狀態碼
    // }
}
