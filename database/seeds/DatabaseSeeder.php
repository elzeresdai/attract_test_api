<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 5)->create();

        factory(App\Messages::class, 20)->create()->each(function(App\Messages $message) use ($users){
            $message->sendMessage()->attach(
                $users->random(1,5)->pluck('id')->toArray(),
                ['to_user_id'=>$users->random()->id]
            );
        });


    }
}
