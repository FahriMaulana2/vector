<?php

use App\Services\ImageOptimizer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('converts uploaded JPEG image to WebP format', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('test-photo.jpg', 200, 200);

    $webpPath = ImageOptimizer::convertToWebp($file, 'marketplaces', 85);

    expect($webpPath)->not->toBeNull()
        ->and(str_ends_with($webpPath, '.webp'))->toBeTrue();

    Storage::disk('public')->assertExists($webpPath);
});

it('converts uploaded PNG image to WebP format while preserving directory path', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('logo.png', 100, 100);

    $webpPath = ImageOptimizer::convertToWebp($file, 'popups', 90);

    expect($webpPath)->not->toBeNull()
        ->and(str_starts_with($webpPath, 'popups/'))->toBeTrue()
        ->and(str_ends_with($webpPath, '.webp'))->toBeTrue();

    Storage::disk('public')->assertExists($webpPath);
});

it('safely deletes old image when new WebP image is converted', function () {
    Storage::fake('public');

    $oldFile = 'marketplaces/old-logo.webp';
    Storage::disk('public')->put($oldFile, 'fake content');

    $file = UploadedFile::fake()->image('new-logo.png', 150, 150);

    $newPath = ImageOptimizer::convertToWebp($file, 'marketplaces', 85, $oldFile);

    expect($newPath)->not->toBeNull();
    Storage::disk('public')->assertMissing($oldFile);
    Storage::disk('public')->assertExists($newPath);
});

it('returns null for non-image or invalid files', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

    $result = ImageOptimizer::convertToWebp($file, 'marketplaces');

    expect($result)->toBeNull();
});
