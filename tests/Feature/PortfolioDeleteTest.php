
<?php

use App\Livewire\Admin\Portfolios\Index as PortfoliosIndex;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('admin can delete a portfolio via livewire delete method', function () {
    $portfolio = Portfolio::create([
        'title' => 'Portofolio Uji',
        'slug' => 'portofolio-uji',
        'description' => 'Deskripsi portofolio uji',
        'is_active' => true,
    ]);

    Livewire::test(PortfoliosIndex::class)
        ->call('delete', $portfolio->id)
        ->assertDispatched('notify');

    $this->assertDatabaseMissing('portfolios', [
        'id' => $portfolio->id,
    ]);
});

it('admin can delete a portfolio via livewire destroy method', function () {
    $portfolio = Portfolio::create([
        'title' => 'Portofolio Destroy Uji',
        'slug' => 'portofolio-destroy-uji',
        'is_active' => true,
    ]);

    Livewire::test(PortfoliosIndex::class)
        ->call('destroy', $portfolio->id)
        ->assertDispatched('notify');

    $this->assertDatabaseMissing('portfolios', [
        'id' => $portfolio->id,
    ]);
});

it('deletes portfolio images from storage when portfolio is deleted', function () {
    Storage::fake('public');

    $imageFile = UploadedFile::fake()->image('cover.jpg');
    $imagePath = $imageFile->store('portfolios', 'public');

    $galleryFile = UploadedFile::fake()->image('gallery1.jpg');
    $galleryPath = $galleryFile->store('portfolios/gallery', 'public');

    $portfolio = Portfolio::create([
        'title' => 'Portofolio Dengan Gambar',
        'slug' => 'portofolio-dengan-gambar',
        'image' => $imagePath,
        'is_active' => true,
    ]);

    PortfolioImage::create([
        'portfolio_id' => $portfolio->id,
        'image' => $galleryPath,
        'is_primary' => false,
    ]);

    Storage::disk('public')->assertExists($imagePath);
    Storage::disk('public')->assertExists($galleryPath);

    Livewire::test(PortfoliosIndex::class)
        ->call('delete', $portfolio->id);

    $this->assertDatabaseMissing('portfolios', ['id' => $portfolio->id]);
    $this->assertDatabaseMissing('portfolio_images', ['image' => $galleryPath]);

    Storage::disk('public')->assertMissing($imagePath);
    Storage::disk('public')->assertMissing($galleryPath);
});

it('admin can delete a portfolio via http delete route', function () {
    $portfolio = Portfolio::create([
        'title' => 'Portofolio HTTP Route',
        'slug' => 'portofolio-http-route',
        'is_active' => true,
    ]);

    $response = $this->delete(route('admin.portfolios.destroy', $portfolio));

    $response->assertRedirect(route('admin.portfolios.index'));
    $response->assertSessionHas('success', 'Portofolio berhasil dihapus.');

    $this->assertDatabaseMissing('portfolios', [
        'id' => $portfolio->id,
    ]);
});

it('guests cannot delete a portfolio via http delete route', function () {
    auth()->logout();

    $portfolio = Portfolio::create([
        'title' => 'Portofolio Guest',
        'slug' => 'portofolio-guest',
        'is_active' => true,
    ]);

    $response = $this->delete(route('admin.portfolios.destroy', $portfolio));

    $response->assertRedirect(route('admin.login'));
    $this->assertDatabaseHas('portfolios', [
        'id' => $portfolio->id,
    ]);
});
