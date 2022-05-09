<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Providers\ImageStorageServiceProvider;
use Storage;

class ImageTest extends TestCase
{


    public function testConvertImage()
    {
        $user = new User();
        $user->id = 1;
        $this->be($user);

        $imageServiceProvider = new ImageStorageServiceProvider('test', 'meals');
        $testImage = Storage::disk('test')->get('1.jpg');
        $imageServiceProvider->uploadAndCreate($testImage, 1);

        // Check if all sizes were created
        $sizes = ['', '-small', '-medium', '-large'];

        foreach ($sizes as $size) {
            $this->assertTrue(Storage::disk('test')->exists('/images/meals/1' . $size . '.jpg'));
            Storage::disk('test')->delete('/images/meals/1' . $size . '.jpg');
        }
    }
}
