<?php

namespace App\Modules\Management\EventManagement\EventFacilities\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Modules\Management\EventManagement\EventFacilities\Models\Model as EventFacility;

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
        $slug = $this->route('slug');
        $is_update = $slug !== null;

        if ($is_update) {
            // Find the record by slug to get its ID
            $eventFacility = EventFacility::where('slug', $slug)->first();
            $currentId = $eventFacility ? $eventFacility->id : null;

            $event_id_rules = [
                'required',
                'sometimes',
                'exists:events,id',
                Rule::unique('event_facilities', 'event_id')->ignore($currentId), // ignore current record
            ];
        } else {
            $event_id_rules = 'required|sometimes|exists:events,id|unique:event_facilities,event_id';
        }

        return [
            'event_id' => $event_id_rules,
            'video_url' => 'required | sometimes',
            'facility' => 'required | sometimes',
            'status' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}