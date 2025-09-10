<?php

namespace App\Modules\Management\SectionHeadingManagement\SectionHeading\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DataStoreValidation extends FormRequest
{
    /**
     * Determine if the  is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * validateError to make this request.
     */
    public function validateError($data)
    {
        $errorPayload =  $data->getMessages();
        return response(['status' => 'validation_error', 'errors' => $errorPayload], 422);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validateError($validator->errors()));
        if ($this->wantsJson() || $this->ajax()) {
            throw new HttpResponseException($this->validateError($validator->errors()));
        }
        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'section_type' => 'required | sometimes',
            'short_title' => 'nullable | sometimes',
            'title' => 'nullable | sometimes',
            'long_title' => 'nullable | sometimes',
            'short_description' => 'nullable | sometimes',
            'description' => 'nullable | sometimes',
            'video_url' => 'nullable | sometimes',
            'primary_image' => 'nullable | sometimes',
            'background_image' => 'nullable | sometimes',
            'side_image' => 'nullable | sometimes',
            'image' => 'nullable | sometimes',
            'special_note' => 'nullable | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}