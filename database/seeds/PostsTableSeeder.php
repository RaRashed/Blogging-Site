<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        $author1 = User::create([
            'name' =>'Rakib',
            'email' =>'rakib@gmail.com',
            'password' => Hash::make('123456')

        ]);
        $author2 = User::create([
            'name' =>'Toha',
            'email' =>'Toha@gmail.com',
            'password' => Hash::make('123456')

        ]);


        $category1 = Category::create([

            'name' => 'News'
        ]);
        $category2 = Category::create([

            'name' => 'Marketing'
        ]);

        $category3 = Category::create([

            'name' => 'Partnership'
        ]);

        $post1 = Post::create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Laravel is an open-source PHP framework, which is robust and easy to understand. It follows a model-view-controller design pattern. Laravel reuses the existing components of different frameworks which helps in creating a web application. The web application thus designed is more structured and pragmatic.',
            'content' => 'Laravel is an open-source PHP framework, which is robust and easy to understand. It follows a model-view-controller design pattern. Laravel reuses the existing components of different frameworks which helps in creating a web application. The web application thus designed is more structured and pragmatic.',
            'category_id' =>$category1->id,
            'image' => 'posts/1.jpg',
            'user_id' =>$author1->id



        ]);
        $post2 = $author2->posts()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'Laravel is an open-source PHP framework, which is robust and easy to understand. It follows a model-view-controller design pattern. Laravel reuses the existing components of different frameworks which helps in creating a web application. The web application thus designed is more structured and pragmatic.',
            'content' => 'Laravel is an open-source PHP framework, which is robust and easy to understand. It follows a model-view-controller design pattern. Laravel reuses the existing components of different frameworks which helps in creating a web application. The web application thus designed is more structured and pragmatic.',
            'category_id' =>$category2->id,
            'image' => 'posts/2.jpg'



        ]);
        $post3 =  $author1->posts()->create([
            'title' => 'New published books to read by a product designer',
            'description' => 'Laravel is an open-source PHP framework, which is robust and easy to understand. It follows a model-view-controller design pattern. Laravel reuses the existing components of different frameworks which helps in creating a web application. The web application thus designed is more structured and pragmatic.',
            'content' => 'Laravel is an open-source PHP framework, which is robust and easy to understand. It follows a model-view-controller design pattern. Laravel reuses the existing components of different frameworks which helps in creating a web application. The web application thus designed is more structured and pragmatic.',
            'category_id' =>$category3->id,
            'image' => 'posts/3.jpg'



        ]);
        $post4 =  $author2->posts()->create([
            'title' => 'This is why its time to ditch dress codes at work',
            'description' => 'Laravel is an open-source PHP framework, which is robust and easy to understand. It follows a model-view-controller design pattern. Laravel reuses the existing components of different frameworks which helps in creating a web application. The web application thus designed is more structured and pragmatic.',
            'content' => 'Laravel is an open-source PHP framework, which is robust and easy to understand. It follows a model-view-controller design pattern. Laravel reuses the existing components of different frameworks which helps in creating a web application. The web application thus designed is more structured and pragmatic.',
            'category_id' =>$category2->id,
            'image' => 'posts/4.jpg'



        ]);
        $tag1 = Tag::create([

            'name' => 'job'
        ]);
        $tag2 = Tag::create([

            'name' => 'customers'
        ]);
        $tag3 = Tag::create([

            'name' => 'record'
        ]);
        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
        $post4->tags()->attach([$tag1->id, $tag2->id]);


    }
}
