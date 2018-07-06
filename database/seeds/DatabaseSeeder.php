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

        $me = App\User::create(
            [
                'name' => 'Nicola',
                'email' => 'galdiolo.nicola@gmail.com',
                'role' => 'admin',
                'password' => bcrypt(env('TESTPASS')),
            ]
        );

        // vogliamo 10 utenti
        $users = factory(App\User::class, 9)->create();

        $users->push($me);

        $categories = factory(App\Category::class, 20)->create();
        $tags = factory(App\Tag::class, 40)->create();

        foreach ($users as $user){
            // per ciascun utente vogliamo 15 post
            $posts = factory(App\Post::class, 15)->create([
                'user_id' => $user->id,
                'category_id' => collect($categories)->random()->id
            ]);

            foreach ($posts as $post){
                //$randomTags = collect($tags)->random(3)->pluck('id')->toArray();
                $randomTags = $tags->random(3)->pluck('id')->toArray();
                $post->tags()->sync($randomTags);
            }
        }

        // ciascun post vogliamo assegnarlo 3 tags random (esistenti)
        // ciascun post vogliamo assegnarlo a una categoria random (esistente)
    }
}
