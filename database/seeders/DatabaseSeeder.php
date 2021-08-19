<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CategoryModel;
use App\Models\ArticleModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        // User::create([
        //     'name' =>  'Kenny',
        //     'email' => 'kenny.perulu@mail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // User::create([
        //     'name' =>  'Feldi',
        //     'email' => 'feldi.amalo@mail.com',
        //     'password' => bcrypt('54321')
        // ]);

        CategoryModel::create([
            'name' => 'Mobile development',
            'slug' => 'mobile-development'
        ]);

        CategoryModel::create([
            'name' => 'Web development',
            'slug' => 'web-development'
        ]);

        CategoryModel::create([
            'name' => 'Biography',
            'slug' => 'biography'
        ]);

        ArticleModel::factory(20)->create();

        // ArticleModel::create([
        //     'category_model_id' => 1,
        //     'user_id' => 1,
        //     'title' => 'Flutter vs React Native',
        //     'slug' => 'flutter-vs-react-native',
        //     'excerpt' => 'React native vs fluter excerpt? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias atque voluptatum ab distinctio architecto earum.',
        //     'body' => 'React native vs fluter body? Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae iure a quam sequi, aut similique voluptatem minima esse. Neque, sint recusandae reiciendis ad illum, quis quia perferendis atque obcaecati cumque aliquam fugiat quo ab! Placeat necessitatibus cumque sequi voluptatum quaerat quia explicabo at eaque exercitationem possimus natus, laborum magni quam.',
        // ]);

        // ArticleModel::create([
        //     'category_model_id' => 2,
        //     'user_id' => 2,
        //     'title' => 'Laravel vs Ruby on rails',
        //     'slug' => 'laravel-vs-ruby-on-rails',
        //     'excerpt' => 'Laravel vs Ruby on rails excerpt? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias atque voluptatum ab distinctio architecto earum.',
        //     'body' => 'Laravel vs Ruby on rails body? Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae iure a quam sequi, aut similique voluptatem minima esse. Neque, sint recusandae reiciendis ad illum, quis quia perferendis atque obcaecati cumque aliquam fugiat quo ab! Placeat necessitatibus cumque sequi voluptatum quaerat quia explicabo at eaque exercitationem possimus natus, laborum magni quam.',
        // ]);

        // ArticleModel::create([
        //     'category_model_id' => 2,
        //     'user_id' => 2,
        //     'title' => 'Laravel vs Codeignitier',
        //     'slug' => 'laravel-vs-codeignitier',
        //     'excerpt' => 'Laravel vs Codeignitier excerpt? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias atque voluptatum ab distinctio architecto earum.',
        //     'body' => 'Laravel vs Codeignitier body? Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae iure a quam sequi, aut similique voluptatem minima esse. Neque, sint recusandae reiciendis ad illum, quis quia perferendis atque obcaecati cumque aliquam fugiat quo ab! Placeat necessitatibus cumque sequi voluptatum quaerat quia explicabo at eaque exercitationem possimus natus, laborum magni quam.',
        // ]);
    }
}
