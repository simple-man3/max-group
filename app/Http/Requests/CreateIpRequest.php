<?php

namespace App\Http\Requests;

use App\Http\Support\Requests\BaseFormRequest;
use Closure;

class CreateIpRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
//            'ip_host' => ['required', 'regex:/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:[0-9]+$/']
            'ip_hosts' => ['required'],
            'ip_hosts.*' => ['required', 'string', 'regex:/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:[0-9]+$/']
        ];
    }

    public function getIpHosts(): array
    {
        return $this->validated()['ip_hosts'];
    }
}
