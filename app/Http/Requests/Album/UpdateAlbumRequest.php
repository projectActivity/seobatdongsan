<?php

namespace App\Http\Requests\Album;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlbumRequest extends FormRequest
{
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
        return [
            'mota' => 'required'
        ];
    }

    /**
     * Get the attributes 
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'mota' => 'Mo ta'
        ];
    }
}
