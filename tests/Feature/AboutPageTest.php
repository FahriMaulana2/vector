<?php

test('about page renders with navbar', function () {
    $response = $this->get(route('about'));
    $response->assertOk();
    // Verify navbar contains "Pesan Sekarang"
    $response->assertSee('Pesan Sekarang');
});
