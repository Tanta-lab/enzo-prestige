<?php
use App\Models\User;

test('admin can see product list', function () {

    $admin = User::factory()->create(['role'=>'admin']);

    $this->actingAs($admin)
        ->get('/admin/products')
        ->assertOk();
});
