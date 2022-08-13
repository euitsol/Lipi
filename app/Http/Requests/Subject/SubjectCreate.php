<?php

namespace App\Http\Requests\Subject;

use App\Helpers\Qs;
use Illuminate\Foundation\Http\FormRequest;

class SubjectCreate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'departments_id' => 'required',
            'my_class_id' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required'
        ];
    }

    public function attributes()
    {
        return  [
            'departments_id' => 'required',
            'my_class_id' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required'
        ];
    }

    protected function getValidatorInstance()
    {
        $input = $this->all();

        $input['teacher_id'] = $input['teacher_id'] ? Qs::decodeHash($input['teacher_id']) : NULL;

        $this->getInputSource()->replace($input);

        return parent::getValidatorInstance();
    }
}
