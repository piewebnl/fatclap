<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealImageRequest extends FormRequest
{

    private $max_upload_size;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setMaxUploadsize();

        return [
            'meal_id' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:' . $this->max_upload_size,
        ];
    }

    public function attributes()
    {
        return [
            'image' => "Maximum file size to upload is " . ini_get('upload_max_filesize'),
        ];
    }


    public function setMaxUploadsize()
    {
        $this->max_upload_size = (int) ini_get('upload_max_filesize') * 1024;
    }
}
