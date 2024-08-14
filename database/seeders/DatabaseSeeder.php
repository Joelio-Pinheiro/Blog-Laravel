<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TextWidget;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Faker\Factory as FakerFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Post::factory(50)->create();
        // $adminUser = User::factory()->create([
        //     'email' => 'admin3@teste.com',
        //     'name' => 'admin3',
        //     'password' => bcrypt('12345678')
        // ]);

        // $adminRole = Role::firstOrCreate(['name' => 'admin']);
        // $adminUser->assignRole($adminRole);


        $faker = FakerFactory::create();
        $widgetsConfig = [
            [
                'key' => 'about-us-sidebar',
                'title' => 'Sobre mim',
                'Content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos sequi iste exercitationem at accusamus a voluptatem, aliquam, velit cupiditate qui cumque, delectus culpa. Minus fuga minima cumque totam id nihil.',
                'active' => true
            ],
            [
                'key' => 'head',
                'title' => 'Lorem Ipsum Dolor Sit Amet',
                'active' => true
            ],
            [
                'key' => 'about_page',
                'title' => 'About Us',
                'content' => 'Todos os arquivos de configuração do framework Laravel estão armazenados no diretório config. Cada opção está documentada, então sinta-se à vontade para revisar os arquivos e se familiarizar com as opções disponíveis.
                Se um banco de dados SQLite não existir para sua aplicação, o Laravel perguntará se você deseja que o banco de dados seja criado. Normalmente, o arquivo de banco de dados SQLite será criado em database/database.sqlite.',
                'active' => true,
                'image' =>  $faker->imageUrl(640, 480, 'cats', true),
            ]
        ];
        $widgets = [];

        foreach($widgetsConfig as $config) {
            $widgets[] = TextWidget::factory()->create($config);
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
