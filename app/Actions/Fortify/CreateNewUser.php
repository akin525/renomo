<?php

namespace App\Actions\Fortify;

use App\Console\encription;
use App\Mail\Emailotp;
use App\Models\Team;
use App\Models\User;
use App\Models\wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string',  'min:6', 'unique:users'],
            'phone' => ['required', 'numeric',  'min:11'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            $wallet= wallet::create([
                'username' => encription::encryptdata($input['username']),
                'balance' => 0,
            ]);
            $receiver=$input ['email'];
            $admin= 'info@renomobilemoney.com';
            Mail::to($receiver)->send(new Emailotp($input));
            Mail::to($admin)->send(new Emailotp($input));
            return tap(User::create([
                'name' => encription::encryptdata($input['name']),
                'email' => encription::encryptdata($input['email']),
                'password' => $input['password'],
                'phone'=>encription::encryptdata($input['phone']),
                'username'=>encription::encryptdata($input['username']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
