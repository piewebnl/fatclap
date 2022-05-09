<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\ImageStorageServiceProvider;
use Illuminate\Http\JsonResponse;
use App\Models\Image;
use App\Http\Requests\MealImageRequest;
use App\Models\Meal;


class MealImageController extends Controller
{
    public function generateName(int $id)
    {
        return $id . '-' . date("Ymdhis");
    }

    public function create(MealImageRequest $request): JsonResponse
    {

        $mealId = (int) $request->input('meal_id');
        $imageId = (int) $request->input('image_id');

        if ($request->file('image')) {

            // delete old images first
            if ($imageId) {
                $this->destroy($imageId);
            }

            // Write new image to storage
            $name = $this->generateName($mealId);
            $imageStorageServiceProvider = new ImageStorageServiceProvider('public', 'meals');
            $imageStorageServiceProvider->uploadAndCreate($request->file('image'), $name);

            $meal = Meal::find($mealId);
            $images = new Image();
            $images->name = $name;
            $meal->images()->save($images);
        }

        // Load the meal again (with relations)
        $meal = Meal::findOrFail($mealId)->toArray();

        return response()->created('Image stored', $meal);
    }



    public function destroy(int $imageId): JsonResponse
    {

        $image = Image::find($imageId);
        if (!$image) {
            return response()->error('Image not found');
        }

        $mealId = $image->imageable_id;

        $this->destroyFromStorage($image->name);

        // delete the record in db
        $image->delete();

        $meal = Meal::findOrFail($mealId)->toArray();

        return response()->success('Image deleted', $meal);
    }


    public function destroyFromStorage(string $filename)
    {
        $imageStorageServiceProvider = new ImageStorageServiceProvider('public', 'meals');
        $imageStorageServiceProvider->deleteAll($filename);
    }
}
