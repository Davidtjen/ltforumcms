<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = new Category();
        $category2 = new Category();
        $category3 = new Category();
        $category4 = new Category();
        $category5 = new Category();
        $category6 = new Category();
        $category7 = new Category();
        $category8 = new Category();

        $category1->name = 'News';
        $category2->name = 'Updates';
        $category3->name = 'Design';
        $category4->name = 'Marketing';
        $category5->name = 'Partnership';
        $category6->name = 'Product';
        $category7->name = 'Hiring';
        $category8->name = 'Offers';

        $category1->save();
        $category2->save();
        $category3->save();
        $category4->save();
        $category5->save();
        $category6->save();
        $category7->save();
        $category8->save();
    }
}
