<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    public function run()
    {
        $features = [
            [
                'title' => [
                    'en' => 'Automated Gifting',
                    'az' => 'Avtomatlaşdırılmış Hədiyyələr',
                ],
                'text' => [
                    'en' => 'Automatically send gifts based on preferences and important dates, ensuring you never miss an occasion.',
                    'az' => 'Əhəmiyyətli tarixlərə və üstünlüklərə əsaslanaraq hədiyyələri avtomatik olaraq göndərin, heç bir əlamətdar hadisəni qaçırmayın.',
                ],
                'icon' => 'gift', // Core icon name only
            ],
            [
                'title' => [
                    'en' => 'Custom Wishes',
                    'az' => 'Fərdi Təbriklər',
                ],
                'text' => [
                    'en' => 'Create personalized messages or use templates to send wishes via SMS or email on scheduled dates.',
                    'az' => 'Fərdi mesajlar yaradın və ya planlaşdırılmış tarixlərdə SMS və ya e-poçt vasitəsilə təbriklər göndərmək üçün şablonlardan istifadə edin.',
                ],
                'icon' => 'heart',
            ],
            [
                'title' => [
                    'en' => 'Contact Management',
                    'az' => 'Əlaqə İdarəçiliyi',
                ],
                'text' => [
                    'en' => 'Easily add, edit, and organize contacts, and set preferences for each person to automate sending options.',
                    'az' => 'Əlaqələri asanlıqla əlavə edin, redaktə edin və təşkil edin və göndərmə seçimlərini avtomatlaşdırmaq üçün hər bir şəxs üçün üstünlüklər təyin edin.',
                ],
                'icon' => 'user-group',
            ],
            [
                'title' => [
                    'en' => 'Gift Tracking',
                    'az' => 'Hədiyyə İzləmə',
                ],
                'text' => [
                    'en' => 'Track the delivery status of sent gifts in real-time, ensuring they arrive on time and in perfect condition.',
                    'az' => 'Göndərilən hədiyyələrin çatdırılma vəziyyətini real vaxtda izləyin, onların vaxtında və mükəmməl vəziyyətdə çatdırıldığından əmin olun.',
                ],
                'icon' => 'truck',
            ],
            [
                'title' => [
                    'en' => 'Payment Integration',
                    'az' => 'Ödəniş İnteqrasiyası',
                ],
                'text' => [
                    'en' => 'Securely handle payments for gifts with integrated payment gateways, offering multiple payment options.',
                    'az' => 'İnteqrasiya olunmuş ödəniş qapıları ilə hədiyyələr üçün ödənişləri təhlükəsiz şəkildə idarə edin, bir neçə ödəniş seçimi təklif edin.',
                ],
                'icon' => 'credit-card',
            ],
            [
                'title' => [
                    'en' => 'Multi-language Support',
                    'az' => 'Çoxdilli Dəstək',
                ],
                'text' => [
                    'en' => 'Cater to a global audience with multi-language support, making the platform accessible to everyone.',
                    'az' => 'Çoxdilli dəstək ilə qlobal auditoriyaya xidmət edin, platformanı hər kəs üçün əlçatan edin.',
                ],
                'icon' => 'globe-alt',
            ],
            [
                'title' => [
                    'en' => 'Wedding Gifts',
                    'az' => 'Toy Hədiyyələri',
                ],
                'text' => [
                    'en' => 'Create a wedding event where guests can gift you money or regular gifts. Manage your wedding gift registry seamlessly.',
                    'az' => 'Qonaqların sizə pul və ya adi hədiyyələr verməsi üçün toy tədbiri yaradın. Toy hədiyyə qeydiyyatını problemsiz idarə edin.',
                ],
                'icon' => 'sparkles',
            ],
            [
                'title' => [
                    'en' => 'Santa Claus',
                    'az' => 'Şaxta Baba',
                ],
                'text' => [
                    'en' => 'Kids can write their wishes to Santa, who will deliver the gifts. Parents manage and pay for the orders, ensuring a magical experience.',
                    'az' => 'Uşaqlar öz arzularını Şaxta Babaya yaza bilərlər, o da hədiyyələri çatdıracaq. Valideynlər sifarişləri idarə edir və ödəniş edirlər, sehrli bir təcrübə təmin edirlər.',
                ],
                'icon' => 'snowflake',
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
