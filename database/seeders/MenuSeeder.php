<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Makanan
            [
                'name' => 'Seblak',
                'description' => 'Seblak khas Temani Ngemil, pedas gurih dengan topping melimpah.',
                'price' => 13000,
                'image' => 'img/products/seblak.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Bakso Jebew',
                'description' => 'Bakso kenyal dengan kuah segar khas Temani Ngemil.',
                'price' => 10000,
                'image' => 'img/products/bakso.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Udang Keju',
                'description' => 'Udang crispy dengan taburan keju melimpah.',
                'price' => 10000,
                'image' => 'img/products/udkej.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Mie Jebew',
                'description' => 'Mie instan dengan topping spesial ala Temani Ngemil.',
                'price' => 11000,
                'image' => 'img/products/mie.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Pangdas Goreng',
                'description' => 'Pangdas goreng crispy dengan bumbu rahasia.',
                'price' => 11000,
                'image' => 'img/products/pangdas.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Ricebowl Teriyaki',
                'description' => 'Nasi dengan topping ayam teriyaki yang lezat.',
                'price' => 12000,
                'image' => 'img/products/ricebol.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Mentai',
                'description' => 'Nasi dengan saus mentai yang creamy dan gurih.',
                'price' => 15000,
                'image' => 'img/products/mentai.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Dimsum',
                'description' => 'Dimsum kukus lembut dengan saus cocolan.',
                'price' => 12000,
                'image' => 'img/products/dimsum.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Gorengan',
                'description' => 'Aneka gorengan renyah, pas untuk cemilan.',
                'price' => 8000,
                'image' => 'img/products/gorengan.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Katsu Bowl',
                'description' => 'Nasi dengan katsu ayam renyah dan saus spesial.',
                'price' => 14000,
                'image' => 'img/products/katsu-bowl.png',
                'category' => 'makanan'
            ],
            [
                'name' => 'Tahu Crispy',
                'description' => 'Tahu goreng krispi, enak untuk cemilan.',
                'price' => 9000,
                'image' => 'img/products/tahu-crispy.png',
                'category' => 'makanan'
            ],

            // Minuman
            [
                'name' => 'Lemon Jeruk',
                'description' => 'Minuman segar dari perasan lemon dan jeruk.',
                'price' => 7000,
                'image' => 'img/products/lemonjeruk.png',
                'category' => 'minuman'
            ],
            [
                'name' => 'Es Teh',
                'description' => 'Es teh manis dingin, pelepas dahaga.',
                'price' => 5000,
                'image' => 'img/products/esteh.png',
                'category' => 'minuman'
            ]
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
