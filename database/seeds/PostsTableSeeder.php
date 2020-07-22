<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post1 = Post::create([
            'title' => 'The standard Lorem Ipsum passage, used since the 1500s',
            'description' => 'The standard Lorem Ipsum passage, used since the 1500s',
            'content' => '<div>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</div>',
            'published_at' => '2020-06-20 09:00:00',
            'image' => 'posts/8Gn6d6yJELkllKIqDy5rkQrqwX9sJ7M8Ylm2zdDN.jpeg',
            'category_id' => 1,
            'user_id' => 2
        ]);

        $post2 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'The standard Lorem Ipsum passage, used since the 1500s',
            'content' => '<div>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</div>',
            'published_at' => '2020-06-20 09:00:00',
            'image' => 'posts/ev1l4F4EGtmVCrLnPm4TTqdHSQDJLnZqeafilcQw.png',
            'category_id' => 2,
            'user_id' => 2
        ]);

        $post3 = Post::create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'The standard Lorem Ipsum passage, used since the 1500s',
            'content' => '<div>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</div>',
            'published_at' => '2020-06-20 09:00:00',
            'image' => 'posts/IWzuy91lodKt09xpPSbMXCFwHIQ3M7JTGdEQAVXU.png',
            'category_id' => 3,
            'user_id' => 2
        ]);

        $post4 = Post::create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'The standard Lorem Ipsum passage, used since the 1500s',
            'content' => '<div>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</div>',
            'published_at' => '2020-06-20 09:00:00',
            'image' => 'posts/lPjdv37UQf7cXU3RWzRonSAV9ZyZrEUatnyzbx1i.png',
            'category_id' => 4,
            'user_id' => 2
        ]);

        $post5 = Post::create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'The standard Lorem Ipsum passage, used since the 1500s',
            'content' => '<div>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</div>',
            'published_at' => '2020-06-20 09:00:00',
            'image' => 'posts/PXRFHpFYbWGFsTMlkVmBzlFbEoWE8qlpfdeO2koH.png',
            'category_id' => 5,
            'user_id' => 2
        ]);

        $post6 = Post::create([
            'title' => 'New published books to read by a product designer',
            'description' => 'The standard Lorem Ipsum passage, used since the 1500s',
            'content' => '<div>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</div>',
            'published_at' => '2020-06-20 09:00:00',
            'image' => 'posts/u856Sc2Rra9shmWIzhcjRDmSOMc0EP0nnhIBAKST.png',
            'category_id' => 6,
            'user_id' => 2
        ]);

        $post7 = Post::create([
            'title' => 'This is why it\'s time to ditch dress codes at work',
            'description' => 'The standard Lorem Ipsum passage, used since the 1500s',
            'content' => '<div>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</div>',
            'published_at' => '2020-06-20 09:00:00',
            'image' => 'posts/W1yzcMngHqlj6moLDsVkWc2KDoXsbhpJIKwn4VkG.jpeg',
            'category_id' => 7,
            'user_id' => 2
        ]);
    }
}
