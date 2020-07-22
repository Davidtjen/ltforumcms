<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment1 = Comment::create([
            'user_id' => 1,
            'body' => 'Was my suppliers, has concept how few everything task music.',
            'commentable_id' => 1,
            'commentable_type' => 'App\Post'
        ]);

        $comment2 = Comment::create([
            'user_id' => 1,
            'body' => 'Been me have the no a themselves, agency, it that if conduct, posts, another who to assistant done rattling forth there the customary imitation.',
            'commentable_id' => 1,
            'commentable_type' => 'App\Post'
        ]);
    }
}
