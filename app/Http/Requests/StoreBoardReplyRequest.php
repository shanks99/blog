<?php

namespace App\Http\Requests;

use App\Models\BoardReply;
use Illuminate\Foundation\Http\FormRequest;

class StoreBoardReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', BoardReply::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=> 'integer',
            'board_id'=> 'integer|required',
            'reply_id'=> '',
            'comment'=> 'string|required',
        ];
    }
}
