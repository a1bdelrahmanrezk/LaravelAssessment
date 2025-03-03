<?php

namespace App\Http\Requests\Api;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string','required'],
            'status' => ['string','required','in:' . implode(',', array_map(fn ($status) => $status->value, TaskStatus::cases()))],
            'user_id' => ['required',Rule::exists('users','id')],
        ];
    }
}
