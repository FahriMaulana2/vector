<?php

use App\Livewire\Hero;
use App\Livewire\Home;
use App\Livewire\Navbar;
use Livewire\Livewire;

it('hero section cta lihat portofolio links to portfolio page', function () {
    Livewire::test(Hero::class)
        ->assertSeeHtml('href="'.route('portfolio.index').'"')
        ->assertDontSeeHtml('href="#portfolio"');
});

it('navbar and home navigation links to portfolio page consistently', function () {
    Livewire::test(Navbar::class)
        ->assertSeeHtml(route('portfolio.index'));

    Livewire::test(Home::class)
        ->assertSeeHtml(route('portfolio.index'));
});
