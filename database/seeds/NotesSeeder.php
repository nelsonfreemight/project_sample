<?php

use Illuminate\Database\Seeder;
use App\Note;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
       public function run()
    {
        for ($i=0; $i < 15; $i++) { 
	    	Note::create([
	            'title' => str_random(10),
	            'content' => str_random(20),
	            'tags' => str_random(15),
	     
	        ]);
    	}
    }
}
