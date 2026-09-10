<?php

use App\Livewire\Admin\About\MilestoneForm;
use App\Livewire\Admin\About\MilestoneIndex;
use App\Livewire\Admin\About\StatForm;
use App\Livewire\Admin\About\StatIndex;
use App\Models\AboutMilestone;
use App\Models\AboutStat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('admin can create a new about stat', function () {
    Livewire::test(StatForm::class)
        ->set('label', 'Klien Puas')
        ->set('value', '1.500+')
        ->set('sort_order', 1)
        ->set('is_active', true)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.about.stats.index'));

    $this->assertDatabaseHas('about_stats', [
        'label' => 'Klien Puas',
        'value' => '1.500+',
        'sort_order' => 1,
        'is_active' => true,
    ]);
});

it('admin can update an existing about stat', function () {
    $stat = AboutStat::create([
        'label' => 'Old Label',
        'value' => '10+',
        'sort_order' => 0,
        'is_active' => true,
    ]);

    Livewire::test(StatForm::class, ['stat' => $stat->id])
        ->set('label', 'Proyek Selesai')
        ->set('value', '2.000+')
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('about_stats', [
        'id' => $stat->id,
        'label' => 'Proyek Selesai',
        'value' => '2.000+',
    ]);
});

it('admin can delete an about stat from stat index', function () {
    $stat = AboutStat::create([
        'label' => 'To Delete',
        'value' => '0',
        'sort_order' => 99,
        'is_active' => false,
    ]);

    Livewire::test(StatIndex::class)
        ->call('delete', $stat->id);

    $this->assertDatabaseMissing('about_stats', [
        'id' => $stat->id,
    ]);
});

it('admin can create a new about milestone', function () {
    Livewire::test(MilestoneForm::class)
        ->set('year', 2021)
        ->set('title', 'Ekspansi Workshop & Mesin Cetak Baru')
        ->set('description', 'Menambah mesin digital printing kapasitas tinggi.')
        ->set('sort_order', 1)
        ->set('is_active', true)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.about.milestones.index'));

    $this->assertDatabaseHas('about_milestones', [
        'year' => 2021,
        'title' => 'Ekspansi Workshop & Mesin Cetak Baru',
        'sort_order' => 1,
        'is_active' => true,
    ]);
});

it('admin can update an existing about milestone', function () {
    $milestone = AboutMilestone::create([
        'year' => 2019,
        'title' => 'Awal Berdiri',
        'description' => 'Mulai merintis',
        'sort_order' => 0,
        'is_active' => true,
    ]);

    Livewire::test(MilestoneForm::class, ['milestone' => $milestone->id])
        ->set('title', 'Pendirian OMAH Vector')
        ->set('year', 2019)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('about_milestones', [
        'id' => $milestone->id,
        'title' => 'Pendirian OMAH Vector',
    ]);
});

it('admin can delete an about milestone from milestone index', function () {
    $milestone = AboutMilestone::create([
        'year' => 2018,
        'title' => 'To Delete',
        'sort_order' => 99,
        'is_active' => false,
    ]);

    Livewire::test(MilestoneIndex::class)
        ->call('delete', $milestone->id);

    $this->assertDatabaseMissing('about_milestones', [
        'id' => $milestone->id,
    ]);
});
