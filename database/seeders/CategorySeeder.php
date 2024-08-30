<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Top-level categories
        $categories = [
            ['name' => ['en' => 'Electronics', 'az' => 'Elektronika'], 'desc' => ['en' => 'All electronic items', 'az' => 'Bütün elektron əşyalar'], 'status' => true, 'sort_order' => 1, 'parent_id' => null],
            ['name' => ['en' => 'Furniture', 'az' => 'Mebel'], 'desc' => ['en' => 'Furniture for home and office', 'az' => 'Ev və ofis üçün mebellər'], 'status' => true, 'sort_order' => 2, 'parent_id' => null],
            ['name' => ['en' => 'Books', 'az' => 'Kitablar'], 'desc' => ['en' => 'Books of various genres', 'az' => 'Müxtəlif janrlarda kitablar'], 'status' => true, 'sort_order' => 3, 'parent_id' => null],
            ['name' => ['en' => 'Clothing', 'az' => 'Geyimlər'], 'desc' => ['en' => 'Clothing for all ages', 'az' => 'Hər yaş üçün geyimlər'], 'status' => true, 'sort_order' => 4, 'parent_id' => null],
            ['name' => ['en' => 'Toys', 'az' => 'Oyuncaqlar'], 'desc' => ['en' => 'Toys for children', 'az' => 'Uşaqlar üçün oyuncaqlar'], 'status' => true, 'sort_order' => 5, 'parent_id' => null],
            ['name' => ['en' => 'Sports', 'az' => 'İdman'], 'desc' => ['en' => 'Sports equipment and accessories', 'az' => 'İdman avadanlıqları və aksesuarları'], 'status' => true, 'sort_order' => 6, 'parent_id' => null],
            ['name' => ['en' => 'Automotive', 'az' => 'Avtomobil'], 'desc' => ['en' => 'Automotive parts and accessories', 'az' => 'Avtomobil hissələri və aksesuarları'], 'status' => true, 'sort_order' => 7, 'parent_id' => null],
            ['name' => ['en' => 'Health & Beauty', 'az' => 'Sağlamlıq və Gözəllik'], 'desc' => ['en' => 'Health and beauty products', 'az' => 'Sağlamlıq və gözəllik məhsulları'], 'status' => true, 'sort_order' => 8, 'parent_id' => null],
            ['name' => ['en' => 'Home & Kitchen', 'az' => 'Ev və Mətbəx'], 'desc' => ['en' => 'Products for home and kitchen', 'az' => 'Ev və mətbəx üçün məhsullar'], 'status' => true, 'sort_order' => 9, 'parent_id' => null],
            ['name' => ['en' => 'Office Supplies', 'az' => 'Ofis Ləvazimatları'], 'desc' => ['en' => 'Supplies for office use', 'az' => 'Ofis üçün ləvazimatlar'], 'status' => true, 'sort_order' => 10, 'parent_id' => null],
        ];

        // Insert top-level categories into the database
        foreach ($categories as $category) {
            Category::create($category);
        }

        // Fetch parent category IDs
        $electronicsId = Category::where('name->en', 'Electronics')->value('id');
        $furnitureId = Category::where('name->en', 'Furniture')->value('id');
        $booksId = Category::where('name->en', 'Books')->value('id');

        // Subcategories for Electronics
        $subcategories = [
            ['name' => ['en' => 'Mobile Phones', 'az' => 'Mobil Telefonlar'], 'desc' => ['en' => 'Smartphones and accessories', 'az' => 'Smartfonlar və aksesuarlar'], 'status' => true, 'sort_order' => 1, 'parent_id' => $electronicsId],
            ['name' => ['en' => 'Laptops', 'az' => 'Noutbuklar'], 'desc' => ['en' => 'Various brands of laptops', 'az' => 'Müxtəlif markalı noutbuklar'], 'status' => true, 'sort_order' => 2, 'parent_id' => $electronicsId],
            ['name' => ['en' => 'Televisions', 'az' => 'Televizorlar'], 'desc' => ['en' => 'LED, OLED, and Smart TVs', 'az' => 'LED, OLED və Smart televizorlar'], 'status' => true, 'sort_order' => 3, 'parent_id' => $electronicsId],
            
            // Subcategories for Furniture
            ['name' => ['en' => 'Living Room', 'az' => 'Qonaq Otağı'], 'desc' => ['en' => 'Furniture for the living room', 'az' => 'Qonaq otağı üçün mebellər'], 'status' => true, 'sort_order' => 1, 'parent_id' => $furnitureId],
            ['name' => ['en' => 'Office Furniture', 'az' => 'Ofis Mebelləri'], 'desc' => ['en' => 'Desks, chairs, and more', 'az' => 'Masalar, oturacaqlar və daha çox'], 'status' => true, 'sort_order' => 2, 'parent_id' => $furnitureId],
            
            // Subcategories for Books
            ['name' => ['en' => 'Fiction', 'az' => 'Bədii ədəbiyyat'], 'desc' => ['en' => 'Fictional books of various genres', 'az' => 'Müxtəlif janrda bədii kitablar'], 'status' => true, 'sort_order' => 1, 'parent_id' => $booksId],
            ['name' => ['en' => 'Non-Fiction', 'az' => 'Qeyri-bədii'], 'desc' => ['en' => 'Educational and informative books', 'az' => 'Təhsil və məlumat kitabları'], 'status' => true, 'sort_order' => 2, 'parent_id' => $booksId],
        ];

        // Insert subcategories into the database
        foreach ($subcategories as $subcategory) {
            Category::create($subcategory);
        }
    }
}
