<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Qs;

class StudentRecordCreate extends FormRequest
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
                    // 'name' => 'required|string|min:6|max:150',
                    // 'father_name' => 'sometimes|nullable|alpha_num|min:3|max:150|unique:student_records',
                    // 'mother_name' => 'required|string',
                    // 'present_address' => 'required|string',
                    // 'phone2' => 'required',
                    // 'address' => 'required',
                    // 'email' => 'sometimes|nullable|email|max:100|unique:users',
                    // 'gender' => 'required',
                    // 'phone' => 'required',
                    // 'dob' => 'required',
                    // 'nationality' => 'required',
                    // 'exam_name' => 'required',
                    // 'passing_year' => 'required',
                    // 'division' => 'required',
                    // 'board' => 'required',
                    // 'roll' => 'required',
                    // 'registration_no' => 'required',
                    // 'gpa' => 'required',
                    // 'reg_card' => 'required|mimes:jpeg,png,pdf,jpg',
                    // 'marksheet' => 'required|mimes:png,jpg,jpeg,pdf',
                    // 'photo' => 'photo|required|mimes:png,jpg,jpeg'
           ];

        //    $this->validate($req,[
            //         'name' => 'required|string|min:6|max:150',
            //         'father_name' => 'sometimes|nullable|alpha_num|min:3|max:150|unique:student_records',
            //         'mother_name' => 'required|string',
            //         'present_address' => 'required|string',
            //         'phone2' => 'required',
            //         'address' => 'required',
            //         'email' => 'sometimes|nullable|email|max:100|unique:users',
            //         'gender' => 'required',
            //         'phone' => 'required',
            //         'dob' => 'required',
            //         'nationality' => 'required',
            //         'exam_name' => 'required',
            //         'passing_year' => 'required',
            //         'division' => 'required',
            //         'board' => 'required',
            //         'roll' => 'required',
            //         'registration_no' => 'required',
            //         'gpa' => 'required',
            //         'reg_card' => 'required|mimes:jpeg,png,pdf,jpg',
            //         'marksheet' => 'required|mimes:png,jpg,jpeg,pdf',
            //         'photo' => 'photo|required|mimes:png,jpg,jpeg'
            //     ],[
            //         'name.required' => 'You have to insert your name',
            //         'father_name.required' => "Father's name required",
            //         'mother_name.required' => "Mother's name is required",
            //         'present_address.required' => 'Present address required',
            //         'address.required' => 'Permanent address is required',
            //         'email.required' => 'E-mail is required',
            //         'gender.required' => 'Select gender',
            //         'phone.required' => 'Phone number is required',
            //         'dob.required' => 'Select date of birth',
            //         'nationality.required' => 'Nationality filed is required',
            //         'exam_name.required' => 'Select exame name',
            //         'passing_year.required' => 'Select passing year',
            //         'division.required' => 'Select division',
            //         'board.required' => 'Select board',
            //         'roll.required' => 'Roll is required',
            //         'registration_no.required' => 'Registration number is required',
            //         'gpa.required' => 'G.P.A is required',
            //         'reg_card.required' => "You have to upload your registration card's photo or pdf",
            //         'marksheet.required' => "You have to upload your Marksheet's photo or pdf",
            //         'photo.required' => "You have to upload your image"
            //     ]);

    }

    public function attributes()
    {
        return  [
                    // 'name.required' => 'You have to insert your name',
                    // 'father_name.required' => "Father's name required",
                    // 'mother_name.required' => "Mother's name is required",
                    // 'present_address.required' => 'Present address required',
                    // 'address.required' => 'Permanent address is required',
                    // 'email.required' => 'E-mail is required',
                    // 'gender.required' => 'Select gender',
                    // 'phone.required' => 'Phone number is required',
                    // 'dob.required' => 'Select date of birth',
                    // 'nationality.required' => 'Nationality filed is required',
                    // 'exam_name.required' => 'Select exame name',
                    // 'passing_year.required' => 'Select passing year',
                    // 'division.required' => 'Select division',
                    // 'board.required' => 'Select board',
                    // 'roll.required' => 'Roll is required',
                    // 'registration_no.required' => 'Registration number is required',
                    // 'gpa.required' => 'G.P.A is required',
                    // 'reg_card.required' => "You have to upload your registration card's photo or pdf",
                    // 'marksheet.required' => "You have to upload your Marksheet's photo or pdf",
                    // 'photo.required' => "You have to upload your image"
        ];
    }

    protected function getValidatorInstance()
    {
        $input = $this->all();

        $input['my_parent_id'] = $input['my_parent_id'] ? Qs::decodeHash($input['my_parent_id']) : NULL;

        $this->getInputSource()->replace($input);

        return parent::getValidatorInstance();
    }
}
