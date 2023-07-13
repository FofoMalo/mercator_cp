<?php

namespace App\Http\Requests;

use App\Rules\IPList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateWorkstationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('workstation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'min:3',
                'max:32',
                'required',
                'unique:workstations,name,NULL,id,deleted_at,NULL',
            ],
            'ip_addresses' => [
                'nullable',
                new IPList(),
            ],
        ];
    }
}
