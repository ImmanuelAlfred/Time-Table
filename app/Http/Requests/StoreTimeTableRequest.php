<?php

namespace App\Http\Requests;

use App\Models\TimeTable;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTimeTableRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('time_table_create');
    }

    public function rules()
    {
        return [
            'time_table' => [
                'array',
            ],
            'department_name_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
