<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Story;
use App\Models\Team;
use App\Models\Mission;
use App\Models\Service;

class DefaultSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'title' => 'Get In Touch',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'address' => '2512, New Market, Eliza Road, Sincher 80 CA, Canada, USA',
            'email' => 'support@example.com',
            'email2' => 'support@example.com',
            'phone' => '(41) 123 521 458',
            'phone2' => '(41) 123 521 458',
            'status' => 'active'
        ]);

        Story::create([
            'title' => 'Our Story',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'content_second' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.',
            'image' => 'frontEnd/img/sb.png',
            'status' => 'active'
        ]);

        Team::create([
            'name' => 'Shaurya Preet',
            'position' => 'Co-Founder',
            'bio' => 'Experienced professional with years of industry knowledge.',
            'image' => 'frontEnd/img/team-1.jpg',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'instagram' => 'https://instagram.com',
            'linkedin' => 'https://linkedin.com',
            'order' => 1,
            'status' => 'active'
        ]);


        Mission::create([
            'image_path' => 'frontEnd/img/city.png',
            'mission_items' => json_encode([
                [
                    'icon_class' => 'fa-solid fa-unlock-keyhole',
                    'title' => 'Fully Secure & 24x7 Dedicated Support',
                    'description' => 'If you are an individual client, or just a business startup looking for good backlinks for your website.',
                    'order' => 1,
                    'status' => 'active'
                ],
                // [
                //     'icon_class' => 'fa-brands fa-twitter',
                //     'title' => 'Manage your Social & Business Account Carefully',
                //     'description' => 'If you are an individual client, or just a business startup looking for good backlinks for your website.',
                //     'order' => 2,
                //     'status' => 'active'
                // ],
                // [
                //     'icon_class' => 'fa-solid fa-layer-group',
                //     'title' => 'We are Very Hard Worker and loving',
                //     'description' => 'If you are an individual client, or just a business startup looking for good backlinks for your website.',
                //     'order' => 3,
                //     'status' => 'active'
                // ]
            ]),
            'status' => 'active'
        ]);


        $services = [
            [
                'title' => 'Evaluate Property',
                'description' => 'Cicero famously orated against his political opponent Lucius Sergius Catilina.',
                'icon' => 'icon-evaluate.svg',
                'image' => null,
                'sort_order' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Meet Your Agent',
                'description' => 'Connect with a professional agent to find your dream property.',
                'icon' => 'icon-agent.svg',
                'image' => null,
                'sort_order' => 2,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Close The Deal',
                'description' => 'Finalize your property purchase quickly and efficiently.',
                'icon' => 'icon-deal.svg',
                'image' => null,
                'sort_order' => 3,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Service::insert($services);

    }
}
