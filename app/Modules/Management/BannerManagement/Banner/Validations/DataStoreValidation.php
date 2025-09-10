<?php

namespace App\Modules\Management\BannerManagement\Banner\Validations;

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
        $errorPayload = $data->getMessages();
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
        $is_update = $this->route('slug') !== null;
        // Image should be required on create, optional on update
        $imageRule = $is_update ? 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120' : 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120';
        return [
            'slogan'           => 'required | sometimes',
            'election_type'    => 'required | sometimes',
            'main_title'       => 'required | sometimes',
            'short_title'      => 'required | sometimes',
            'description'      => 'required | sometimes',
            'perma_link'       => 'required | sometimes',
            'image'            => $imageRule,
            'background_image' => $imageRule,
            'status'           => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}