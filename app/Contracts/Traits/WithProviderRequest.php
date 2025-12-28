<?php

namespace Modules\Notifier\Contracts\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Notifier\Models\Provider;

abstract class WithProviderRequest extends FormRequest
{
    protected null|Builder|Model|Provider $provider = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * add another validation rules
     *
     * @return array
     */
    abstract public function addRules(): array;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge($this->addRules(), [
            'provider' => ['required', 'string', Rule::exists((new Provider)->getTable(), 'slug')],
        ]);
    }
}
