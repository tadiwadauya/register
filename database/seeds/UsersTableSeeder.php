<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $profile = new Profile();
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();

        // Seed test admin
        $seededAdminEmail = 'vguyo@whelson.co.zw';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'vguyo',
                'paynumber'                      => '25',
                'first_name'                     => 'Vincent',
                'last_name'                      => 'Guyo',
                'email'                          => $seededAdminEmail,
                'location'                          => 'Harare',
                'ip_address'                          => '192.168.1.23',
                'department'                     => 'I.T',
                'position'                     => 'Systems Applications Administrator',
                'mobile'                     => '0773418009',
                'backable'                     => true,
                'password'                       => Hash::make('Iamr00t!@#'),
                'password_changed'                       => true,
                'pwd_last_changed'                       => now(),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save($profile);
            $user->attachRole($adminRole);
            $user->save();
        }

        // Seed test user
        $user = User::where('email', '=', 'user@whelson.co.zw')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'paynumber'                      => $faker->numberBetween(0,1000),
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => 'user@whelson.co.zw',
                'location'                          => 'Chirundu',
                'ip_address'                          => 'DHCP',
                'department'                          => 'I.T',
                'position'                          => 'Systems Administrator',
                'mobile'                     => '0771234567',
                'backable'                     => false,
                'password'                       => Hash::make('pass12345'),
                'password_changed'                       => true,
                'pwd_last_changed'                       => now(),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($userRole);
            $user->save();
        }

        // Seed test users
        // $user = factory(App\Models\Profile::class, 5)->create();
        // $users = User::All();
        // foreach ($users as $user) {
        //     if (!($user->isAdmin()) && !($user->isUnverified())) {
        //         $user->attachRole($userRole);
        //     }
        // }
    }
}
