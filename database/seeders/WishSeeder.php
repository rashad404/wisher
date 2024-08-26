<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wish;

class WishSeeder extends Seeder
{
    public function run()
    {
        $wishes = [
            // Yeni il bayramı
            [
                'lang' => 'az',
                'event_id' => 1,
                'title' => 'Yeni il Bayramı Təbriki 1',
                'text' => 'Yeni iliniz mübarək! Sağlam və uğurlu bir il arzu edirəm.',
            ],
            [
                'lang' => 'az',
                'event_id' => 1,
                'title' => 'Yeni il Bayramı Təbriki 2',
                'text' => 'Yeni il sevinc, xoşbəxtlik və müvəffəqiyyət dolu olsun!',
            ],
            [
                'lang' => 'az',
                'event_id' => 1,
                'title' => 'Yeni il Bayramı Təbriki 3',
                'text' => 'Yeni ildə bütün arzularınız çin olsun! Bayramınız mübarək!',
            ],

            // Ümumxalq hüzn günü
            [
                'lang' => 'az',
                'event_id' => 2,
                'title' => 'Ümumxalq Hüzn Günü Mesajı 1',
                'text' => 'Tariximizin acı günü. Şəhidlərimizi hörmətlə anırıq.',
            ],
            [
                'lang' => 'az',
                'event_id' => 2,
                'title' => 'Ümumxalq Hüzn Günü Mesajı 2',
                'text' => 'Şəhidlərimizin ruhu şad olsun. Heç zaman unudulmayacaqlar.',
            ],
            [
                'lang' => 'az',
                'event_id' => 2,
                'title' => 'Ümumxalq Hüzn Günü Mesajı 3',
                'text' => 'Vətən uğrunda canını fəda edənlərimizi unutmayaq. Ruhları şad olsun.',
            ],

            // Qadınlar günü
            [
                'lang' => 'az',
                'event_id' => 3,
                'title' => '8 Mart Təbriki 1',
                'text' => 'Bütün qadınların 8 mart Qadınlar günü mübarək olsun!',
            ],
            [
                'lang' => 'az',
                'event_id' => 3,
                'title' => '8 Mart Təbriki 2',
                'text' => 'Qadınlar gününüz mübarək! Sizə sevgi dolu bir gün arzu edirəm.',
            ],
            [
                'lang' => 'az',
                'event_id' => 3,
                'title' => '8 Mart Təbriki 3',
                'text' => 'Dünya qadınlar günündə, bütün qadınlara sevgi və xoşbəxtlik arzulayıram.',
            ],

            // Novruz bayramı
            [
                'lang' => 'az',
                'event_id' => 4,
                'title' => 'Novruz Bayramı Təbriki 1',
                'text' => 'Novruz bayramınız mübarək! Sevinc dolu bir bayram arzulayıram.',
            ],
            [
                'lang' => 'az',
                'event_id' => 4,
                'title' => 'Novruz Bayramı Təbriki 2',
                'text' => 'Novruzun bərəkəti evinizdən əksik olmasın! Bayramınız mübarək.',
            ],
            [
                'lang' => 'az',
                'event_id' => 4,
                'title' => 'Novruz Bayramı Təbriki 3',
                'text' => 'Novruz bayramının gətirdiyi xoşbəxtlik daim sizinlə olsun.',
            ],

            // Ramazan bayramı
            [
                'lang' => 'az',
                'event_id' => 5,
                'title' => 'Ramazan Bayramı Təbriki 1',
                'text' => 'Ramazan bayramınız mübarək olsun! Sağlam və xoşbəxt günlər arzulayıram.',
            ],
            [
                'lang' => 'az',
                'event_id' => 5,
                'title' => 'Ramazan Bayramı Təbriki 2',
                'text' => 'Ramazan bayramınız mübarək! Dualarınız qəbul olsun.',
            ],
            [
                'lang' => 'az',
                'event_id' => 5,
                'title' => 'Ramazan Bayramı Təbriki 3',
                'text' => 'Ramazan bayramının bərəkəti və xeyri evinizə dolsun.',
            ],

            // Faşizm üzərində qələbə günü
            [
                'lang' => 'az',
                'event_id' => 6,
                'title' => 'Qələbə Günü Mesajı 1',
                'text' => 'Faşizm üzərində qələbə gününüz mübarək olsun!',
            ],
            [
                'lang' => 'az',
                'event_id' => 6,
                'title' => 'Qələbə Günü Mesajı 2',
                'text' => 'Tarixi qələbəmizin qəhrəmanlarını hörmətlə anırıq.',
            ],
            [
                'lang' => 'az',
                'event_id' => 6,
                'title' => 'Qələbə Günü Mesajı 3',
                'text' => 'Qələbə günü münasibətilə bütün qəhrəmanlara təşəkkür edirik.',
            ],

            // Müstəqillik Günü
            [
                'lang' => 'az',
                'event_id' => 7,
                'title' => 'Müstəqillik Günü Təbriki 1',
                'text' => 'Müstəqillik gününüz mübarək olsun! Vətənimiz üçün xoşbəxt günlər arzulayıram.',
            ],
            [
                'lang' => 'az',
                'event_id' => 7,
                'title' => 'Müstəqillik Günü Təbriki 2',
                'text' => 'Müstəqillik günü sevincini sizinlə bölüşürəm. Vətənimiz daim müstəqil olsun!',
            ],
            [
                'lang' => 'az',
                'event_id' => 7,
                'title' => 'Müstəqillik Günü Təbriki 3',
                'text' => 'Bu gün müstəqilliyimizi qeyd edirik! Müstəqilliyimiz əbədi olsun.',
            ],

            // Azərbaycan xalqının milli qurtuluş günü
            [
                'lang' => 'az',
                'event_id' => 8,
                'title' => 'Milli Qurtuluş Günü Təbriki 1',
                'text' => 'Milli qurtuluş günümüz mübarək! Bu günə qədər gəldiyimiz üçün qürur duyuruq.',
            ],
            [
                'lang' => 'az',
                'event_id' => 8,
                'title' => 'Milli Qurtuluş Günü Təbriki 2',
                'text' => 'Qurtuluş günümüz xeyirli və uğurlu olsun! Vətənimizə daha yaxşı günlər arzulayıram.',
            ],
            [
                'lang' => 'az',
                'event_id' => 8,
                'title' => 'Milli Qurtuluş Günü Təbriki 3',
                'text' => 'Milli qurtuluşumuzun sevinci və qüruru daim sizinlə olsun.',
            ],

            // Azərbaycan Respublikasının Silahlı Qüvvələri günü
            [
                'lang' => 'az',
                'event_id' => 9,
                'title' => 'Silahlı Qüvvələr Günü Təbriki 1',
                'text' => 'Silahlı Qüvvələr gününüz mübarək olsun! Qəhrəman əsgərlərimizə təşəkkürlər!',
            ],
            [
                'lang' => 'az',
                'event_id' => 9,
                'title' => 'Silahlı Qüvvələr Günü Təbriki 2',
                'text' => 'Əsgərlərimizin xidmətlərinə görə minnətdarıq! Silahlı Qüvvələr gününüz mübarək!',
            ],
            [
                'lang' => 'az',
                'event_id' => 9,
                'title' => 'Silahlı Qüvvələr Günü Təbriki 3',
                'text' => 'Vətənimiz uğrunda fədakarlıq edən hər kəsi təbrik edirik. Silahlı Qüvvələr gününüz mübarək!',
            ],

            // Qurban bayramı
            [
                'lang' => 'az',
                'event_id' => 10,
                'title' => 'Qurban Bayramı Təbriki 1',
                'text' => 'Qurban bayramınız mübarək olsun! Allah qurbanlarınızı qəbul etsin.',
            ],
            [
                'lang' => 'az',
                'event_id' => 10,
                'title' => 'Qurban Bayramı Təbriki 2',
                'text' => 'Qurban bayramının bərəkəti hər zaman evinizdə olsun. Bayramınız mübarək!',
            ],
            [
                'lang' => 'az',
                'event_id' => 10,
                'title' => 'Qurban Bayramı Təbriki 3',
                'text' => 'Qurban bayramınızda sevdiklərinizlə birlikdə bol xoşbəxtlik arzulayıram.',
            ],

            // Zəfər Günü
            [
                'lang' => 'az',
                'event_id' => 11,
                'title' => 'Zəfər Günü Təbriki 1',
                'text' => 'Zəfər gününüz mübarək! Qələbə sevincimiz daim yaşasın.',
            ],
            [
                'lang' => 'az',
                'event_id' => 11,
                'title' => 'Zəfər Günü Təbriki 2',
                'text' => 'Tariximizin zəfərini qeyd edirik. Zəfər gününüz mübarək olsun!',
            ],
            [
                'lang' => 'az',
                'event_id' => 11,
                'title' => 'Zəfər Günü Təbriki 3',
                'text' => 'Qələbə günümüzün sevinci daim bizimlədir. Zəfər gününüz mübarək!',
            ],

            // Azərbaycan Respublikasının Dövlət bayrağı günü
            [
                'lang' => 'az',
                'event_id' => 12,
                'title' => 'Dövlət Bayrağı Günü Təbriki 1',
                'text' => 'Dövlət bayrağı günümüz mübarək! Bayrağımız hər zaman yüksəkdə dalğalansın.',
            ],
            [
                'lang' => 'az',
                'event_id' => 12,
                'title' => 'Dövlət Bayrağı Günü Təbriki 2',
                'text' => 'Bayrağımızın qüruru və şərəfi daim yüksəkdə olsun! Bayrağımız mübarək!',
            ],
            [
                'lang' => 'az',
                'event_id' => 12,
                'title' => 'Dövlət Bayrağı Günü Təbriki 3',
                'text' => 'Bayrağımızın şərəfini daim uca tutaraq qeyd edirik. Dövlət bayrağı gününüz mübarək!',
            ],

            // Dünya azərbaycanlılarının həmrəyliyi günü
            [
                'lang' => 'az',
                'event_id' => 13,
                'title' => 'Həmrəylik Günü Təbriki 1',
                'text' => 'Dünya azərbaycanlılarının həmrəyliyi günümüz mübarək olsun! Birliyimiz daim olsun.',
            ],
            [
                'lang' => 'az',
                'event_id' => 13,
                'title' => 'Həmrəylik Günü Təbriki 2',
                'text' => 'Bütün azərbaycanlılara həmrəylik günü münasibətilə sevgi və sülh arzulayıram.',
            ],
            [
                'lang' => 'az',
                'event_id' => 13,
                'title' => 'Həmrəylik Günü Təbriki 3',
                'text' => 'Azərbaycanlıların birliyini və həmrəyliyini qeyd edirik. Həmrəylik günümüz mübarək!',
            ],
        ];

        foreach ($wishes as $wish) {
            Wish::create($wish);
        }
    }
}
