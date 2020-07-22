<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag1 = new Tag();
        $tag2 = new Tag();
        $tag3 = new Tag();
        $tag4 = new Tag();
        $tag5 = new Tag();
        $tag6 = new Tag();
        $tag7 = new Tag();
        $tag8 = new Tag();
        $tag9 = new Tag();
        $tag10 = new Tag();
        $tag11 = new Tag();

        $tag1->name = 'Record';
        $tag1->save();

        $tag2->name = 'Progress';
        $tag2->save();

        $tag3->name = 'Customers';
        $tag3->save();

        $tag4->name = 'Freebie';
        $tag4->save();

        $tag5->name = 'Offer';
        $tag5->save();

        $tag6->name = 'Screenshot';
        $tag6->save();

        $tag7->name = 'Milestone';
        $tag7->save();

        $tag8->name = 'Version';
        $tag8->save();

        $tag9->name = 'Design';
        $tag9->save();

        $tag10->name = 'Customers';
        $tag10->save();

        $tag11->name = 'Job';
        $tag11->save();
    }
}
