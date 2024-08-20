<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $blogs = [
            [
                'title' => [
                    'en' => 'How to Choose the Perfect Gift',
                    'az' => 'Mükəmməl Hədiyyəni Necə Seçmək Olar'
                ],
                'content' => [
                    'en' => '<p>Choosing the perfect gift can be a challenge. Here are some tips to help you select a meaningful gift for any occasion.</p>',
                    'az' => '<p>Mükəmməl hədiyyəni seçmək çətin ola bilər. Hər hansı bir tədbir üçün mənalı bir hədiyyə seçməyə kömək edəcək bəzi tövsiyələr.</p>'
                ],
                'image' => 'path/to/image1.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Top 10 Birthday Gift Ideas',
                    'az' => 'Ən Yaxşı 10 Ad Günü Hədiyyəsi Fikirləri'
                ],
                'content' => [
                    'en' => '<p>Looking for birthday gift ideas? Here are the top 10 gifts that will make your loved ones smile.</p>',
                    'az' => '<p>Ad günü hədiyyə fikirləri axtarırsınız? Sevdiklərinizi güldürəcək ən yaxşı 10 hədiyyə burada.</p>'
                ],
                'image' => 'path/to/image2.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'The Importance of Remembering Special Dates',
                    'az' => 'Xüsusi Tarixləri Xatırlamağın Əhəmiyyəti'
                ],
                'content' => [
                    'en' => '<p>Never miss an important date again. Learn how to stay organized and ensure you celebrate every special moment.</p>',
                    'az' => '<p>Artıq heç vaxt vacib bir tarixi qaçırmayın. Nizamlı qalmağı və hər xüsusi anı qeyd etməyi öyrənin.</p>'
                ],
                'image' => 'path/to/image3.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'How to Create a Gift Registry for Your Wedding',
                    'az' => 'Toyunuz Üçün Hədiyyə Siyahısını Necə Yaratmaq Olar'
                ],
                'content' => [
                    'en' => '<p>Creating a wedding gift registry can simplify the gift-giving process. Here\'s how to set one up on Wisher.az.</p>',
                    'az' => '<p>Toy hədiyyə siyahısı yaratmaq hədiyyə vermə prosesini sadələşdirə bilər. Budur, Wisher.az-da necə qurulacağı.</p>'
                ],
                'image' => 'path/to/image4.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Why Personalized Wishes Matter',
                    'az' => 'Fərdi Təbriklər Niyə Vacibdir'
                ],
                'content' => [
                    'en' => '<p>Personalized wishes can make your messages more meaningful. Discover the power of a customized greeting.</p>',
                    'az' => '<p>Fərdi təbriklər mesajlarınızı daha mənalı edə bilər. Fərdiləşdirilmiş təbrikin gücünü kəşf edin.</p>'
                ],
                'image' => 'path/to/image5.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'How to Organize Your Contacts for Gift-Giving',
                    'az' => 'Hədiyyə Vermək Üçün Əlaqələrinizi Necə Təşkil Etmək Olar'
                ],
                'content' => [
                    'en' => '<p>Organizing your contacts can make gift-giving easier. Learn how to manage your contact list on Wisher.az.</p>',
                    'az' => '<p>Əlaqələrinizi təşkil etmək hədiyyə verməyi asanlaşdıra bilər. Wisher.az-da əlaqə siyahınızı necə idarə edəcəyinizi öyrənin.</p>'
                ],
                'image' => 'path/to/image6.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Celebrating Anniversaries: Tips and Ideas',
                    'az' => 'Yubileyləri Qeyd Etmək: Məsləhətlər və Fikirlər'
                ],
                'content' => [
                    'en' => '<p>Make your anniversary unforgettable with these celebration ideas. Whether it\'s your first or fiftieth, we have tips for you.</p>',
                    'az' => '<p>Yubileyinizi unudulmaz edin bu qeyd fikirləri ilə. İlk və ya əlli, sizin üçün məsləhətlərimiz var.</p>'
                ],
                'image' => 'path/to/image7.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'The Ultimate Guide to Holiday Gift Giving',
                    'az' => 'Bayram Hədiyyəsi Verməyə Dair Ən Yaxşı Rəhbər'
                ],
                'content' => [
                    'en' => '<p>Holiday seasons can be stressful, but gift-giving doesn\'t have to be. Follow our guide for stress-free holiday shopping.</p>',
                    'az' => '<p>Bayram mövsümləri stresli ola bilər, lakin hədiyyə vermək belə olmamalıdır. Stressiz bayram alış-verişi üçün rəhbərimizə əməl edin.</p>'
                ],
                'image' => 'path/to/image8.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Making the Most of Wisher.az Features',
                    'az' => 'Wisher.az Xüsusiyyətlərindən Ən Yaxşı Şəkildə İstifadə Etmək'
                ],
                'content' => [
                    'en' => '<p>Wisher.az is packed with features to help you stay organized and thoughtful. Here\'s how to make the most of them.</p>',
                    'az' => '<p>Wisher.az sizi nizamlı və düşüncəli saxlamaq üçün xüsusiyyətlərlə doludur. Budur, onlardan necə maksimum istifadə etmək olar.</p>'
                ],
                'image' => 'path/to/image9.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
            [
                'title' => [
                    'en' => 'Why Wisher.az is Your Best Choice for Gift-Giving',
                    'az' => 'Wisher.az Niyə Hədiyyə Vermək Üçün Ən Yaxşı Seçiminizdir'
                ],
                'content' => [
                    'en' => '<p>Find out why Wisher.az is the best platform for managing your gifts and special occasions, all in one place.</p>',
                    'az' => '<p>Niyə Wisher.az-ın hədiyyələrinizi və xüsusi tədbirlərinizi idarə etmək üçün ən yaxşı platforma olduğunu öyrənin, hamısı bir yerdə.</p>'
                ],
                'image' => 'path/to/image10.jpg',
                'author' => 'Admin',
                'published_at' => now(),
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::firstOrCreate($blog);
        }
    }
}
