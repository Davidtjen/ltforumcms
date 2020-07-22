<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Home or other Tech', 'slug' => str_slug('Home or other Tech')];
        $channel2 = ['title' => 'Laravel', 'slug' => str_slug('Laravel')];
        $channel3 = ['title' => 'Spring Boot', 'slug' => str_slug('Spring Boot')];
        $channel4 = ['title' => 'SQL Server Administration', 'slug' => str_slug('SQL Server Administration')];
        $channel5 = ['title' => 'SQL Server Integration Services', 'slug' => str_slug('SQL Server Integration Services')];
        $channel6 = ['title' => 'Linux Administration', 'slug' => str_slug('Linux Administration')];
        $channel7 = ['title' => 'Vuejs', 'slug' => str_slug('Vuejs')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);
    }
}
