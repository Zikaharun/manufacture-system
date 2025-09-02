<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\Concerns\Has;
use Tests\TestCase;

class MaterialTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from materials');
    }

    public function testMaterials()
    {
        $users =  User::where('email', 'admin@localhost')->first();

        $this->actingAs($users)->post('/materials', [
            'name' => 'Jeruk segar',
            'unit' => 'kg',
            'cost_price' => 20000,
            'stock' => 150,
            'minimum_stock' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ])->assertRedirect('/materials');
    }
}
