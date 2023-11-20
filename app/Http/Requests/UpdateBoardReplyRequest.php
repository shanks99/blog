<?php

namespace App\Http\Requests;

use App\Models\BoardReply;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBoardReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', BoardReply::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'comment'=> 'string|required',
        ];
    }
}
