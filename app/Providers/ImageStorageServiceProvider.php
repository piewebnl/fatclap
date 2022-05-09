<?php

namespace App\Providers;

use Intervention\Image\Facades\Image;
use Storage;
use Config;


// Handles storing image on disk

class ImageStorageServiceProvider
{
    /**
     * What storage disk to use
     * 
     * @var string 
     */
    private $storageDisk = "public";

    /**
     * Folder name (example: meals)
     * @var string 
     */
    private $folderName;

    /**
     * Full filename without any .jpg extentions (example: images/meal/5-20211001204553)
     * 
     * @var string 
     */
    private $filenameWithoutExtention;

    /**
     * All possible image size variations (see: config/fatclap()
     * 
     * @var array 
     */
    private $imageVariations;

    /**
     *  Create and/or delete image (multiple variations) of an uploaded image to storage
     */

    public function __construct(string $storageDisk, string $folderName)
    {
        $this->storageDisk = $storageDisk;
        $this->folderName = $folderName;
        $this->imageVariations = config('fatclap.image_variations');
    }


    public function setFilenameWithoutExtention(string $filename)
    {
        $this->filenameWithoutExtention = 'images/' . $this->folderName . '/' . $filename;
    }


    // Create all version of and uplaoded image to storage
    public function uploadAndCreate(string $uploadedImage, string $filename)
    {
        $this->setFilenameWithoutExtention($filename);
        $this->createAll($uploadedImage);
    }


    // Delete all version from storage
    public function deleteAll(string $filename)
    {
        $this->setFilenameWithoutExtention($filename);

        Storage::disk($this->storageDisk)->delete($this->filenameWithoutExtention . '.jpg');
        foreach ($this->imageVariations as $key => $imageVariation) {
            Storage::disk($this->storageDisk)->delete($this->filenameWithoutExtention . '-' . $key . '.jpg');
        }
    }

    // Create all versions of image
    private function createAll(string $uploadedImage)
    {

        $this->resize($uploadedImage, $this->filenameWithoutExtention . '.jpg');

        // Create and store all variations
        foreach ($this->imageVariations as $key => $imageVariation) {
            $this->resize($uploadedImage, $this->filenameWithoutExtention . '-' . $key . '.jpg', $imageVariation['width'], $imageVariation['height']);
        }
    }

    private function resize(string $uploadedImage, string $imageName, ?int $width = null, ?int $height = null)
    {

        $exif = Image::make($uploadedImage)->exif();

        $image = Image::make($uploadedImage);

        if ($width > 0 and $height > 0) {
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if (isset($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 8:
                    $image->rotate(90);
                    break;
                case 3:
                    $image->rotate(180);
                    break;
                case 6:
                    $image->rotate(-90);
                    break;
                default:
                    $image;
            }
        }

        $image = $image->stream();

        Storage::disk($this->storageDisk)->put($imageName, $image);
    }
}
