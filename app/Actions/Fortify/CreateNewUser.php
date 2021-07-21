<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'ic' => ['required', 'digits:12', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $id =   DB::table('users')
                ->select(DB::raw("(CASE WHEN MAX(id) IS NULL
                THEN CONCAT(YEAR(CURRENT_TIME),'001')
                ELSE CONCAT(YEAR(CURRENT_TIME), LPAD((CONVERT(SUBSTRING_INDEX(MAX(id),CONCAT(YEAR(CURRENT_TIME)),-1),UNSIGNED INTEGER) + 1),3,'0')) END) AS id"))
                ->whereRaw('SUBSTR(id,1,4) = YEAR(CURRENT_TIME)')
                ->get();

        // dd($id[0]->id);

        return User::create([
            'id' => $id[0]->id,
            'ic' => $input['ic'],
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
