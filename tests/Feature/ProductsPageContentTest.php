<?php

declare(strict_types=1);

use App\Models\User;

it('admin can access products page content management route', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.products.page-content'))
        ->assertOk();
});
