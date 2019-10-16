<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //encendemos
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required',//que sea obligatorio
            'slug'              => 'required|unique:posts,slug',//y no se evalue a si mismo.
            'user_id'           => 'required|integer',
            'category_id'       => 'required|integer',
            'body'              => 'required',
            'status'            => 'required|in:DRAFT,PUBLISHED',
            'file'              => 'file|mimes:jpg,jpeg,png',
        
        ];
    }
}
