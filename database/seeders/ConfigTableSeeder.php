<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;


class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::create([
            'app_name' => 'Viezu - VLF PORTAL', // String
            'app_name_abv'  => 'VLF', // String
            'app_slogan'  => 'Managing VLF Data', // String
            'captcha'  => 'F', // 'T' or 'F'
            'datasitekey'  => '', //String
            'recaptcha_secret'  => '', //String
            'img_login'  => 'T', // 'T' or 'F'
            'caminho_img_login'  => 'img/config/vlf-transp.png', //String -> defaut: 'img/config/logo.png'
            'tamanho_img_login'  => '40', // Integer
            'titulo_login'  => '<a href="#" ><b>VLF</b> PORTAL</a>', //String
            'layout'  => 'fixed', //String -> defaut: 'fixed'
            'skin'  => 'blue', //String -> defaut: 'blue'
            'favicon'  => 'img/config/favicon.png', //String
        ]);
    }
}
