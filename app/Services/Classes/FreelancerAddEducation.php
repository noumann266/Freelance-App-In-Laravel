<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\Services\BaseService;
use App\User;
use App\FreelancerEducation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class FreelancerAddEducation extends BaseService
{
    public function addEducation($data){
        $msg = array();
        $status = false;
        if (Auth::user()->userDetail->userEducation->count() <= 4) {
            $this->validateData($data)->validate();
            $data = $this->processDataToStore($data);
            if (FreelancerEducation::create($data)) {
                $status = true;
                $msg[] = 'Education Added';
            } else {
                $msg[] = 'Something went wrong';
            }
        }
        else{
            $msg[] = 'You reached your limit to add education to your profile';
        }
        $data = array(
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }

    private function validateData($data){
        return Validator::make($data, [
            'degree_title' => ['required', 'string', 'min:3' , 'max:40'],
            'description' => ['required', 'string', 'min:3' , 'max:500'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
    }
}