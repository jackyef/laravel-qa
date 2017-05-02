<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // users seed
//        DB::table('users')->insert([
//            'username' => 'admin',
//            'email' => 'admin' . '@gmail.com',
//            'password' => sha1('admin123'),
//        ]);
        DB::table('users')->insert([
            'username' => str_random(10),
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        DB::table('users')->insert([
            'username' => str_random(10),
            'email' => str_random(10) . '@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        // tags seed
        DB::table('tags')->insert([
            'tag' => 'php',
        ]);
        DB::table('tags')->insert([
            'tag' => 'html',
        ]);
        DB::table('tags')->insert([
            'tag' => 'laravel',
        ]);
        DB::table('tags')->insert([
            'tag' => 'css',
        ]);
        DB::table('tags')->insert([
            'tag' => 'apache',
        ]);

        // questions seed
        $i = 1;
        while($i <= 23){
            DB::table('questions')->insert([
                'question_title' => 'How do I ' . str_random(5) . '?',
                'user_id' => random_int(1, 3),
                'accepted_answer_id' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            DB::table('posts')->insert([
                'post_content' => 'Have you tried ' . str_random(5) . '?',
                'votes' => random_int(1, 99),
                'user_id' => random_int(1, 3),
                'question_id' => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $i++;
        }

        // posts seed
        DB::table('posts')->insert([
            'post_content' => 'Have you tried ' . str_random(5) . '?',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'question_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('posts')->insert([
            'post_content' => 'Have you tried ' . str_random(5) . '?',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'question_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('posts')->insert([
            'post_content' => 'Have you tried ' . str_random(5) . '?',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'question_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('posts')->insert([
            'post_content' => 'Have you tried ' . str_random(5) . '?',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'question_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('posts')->insert([
            'post_content' => 'Have you tried ' . str_random(5) . '?',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'question_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('posts')->insert([
            'post_content' => 'Have you tried ' . str_random(5) . '?',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'question_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // comments seed
        DB::table('comments')->insert([
            'comment' => 'I think ' . str_random(5) . ' will work better.',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'post_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('comments')->insert([
            'comment' => 'I think ' . str_random(5) . ' will work better.',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'post_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('comments')->insert([
            'comment' => 'I think ' . str_random(5) . ' will work better.',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'post_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('comments')->insert([
            'comment' => 'I think ' . str_random(5) . ' will work better.',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'post_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('comments')->insert([
            'comment' => 'I think ' . str_random(5) . ' will work better.',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'post_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('comments')->insert([
            'comment' => 'I think ' . str_random(5) . ' will work better.',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'post_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('comments')->insert([
            'comment' => 'I think ' . str_random(5) . ' will work better.',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'post_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('comments')->insert([
            'comment' => 'I think ' . str_random(5) . ' will work better.',
            'votes' => random_int(1, 99),
            'user_id' => random_int(1, 3),
            'post_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // question_has_tags seed
        DB::table('question_has_tags')->insert([
            'question_id' => random_int(1, 3),
            'tag_id' => random_int(1, 5),
        ]);

        DB::table('question_has_tags')->insert([
            'question_id' => random_int(1, 3),
            'tag_id' => random_int(1, 5),
        ]);

        DB::table('question_has_tags')->insert([
            'question_id' => random_int(1, 3),
            'tag_id' => random_int(1, 5),
        ]);

        DB::table('question_has_tags')->insert([
            'question_id' => random_int(1, 3),
            'tag_id' => random_int(1, 5),
        ]);

        DB::table('question_has_tags')->insert([
            'question_id' => random_int(1, 3),
            'tag_id' => random_int(1, 5),
        ]);


    }
}
