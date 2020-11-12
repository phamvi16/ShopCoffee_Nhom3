<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Tạo dữ liệu rác
        // // \App\Models\User::factory(10)->create();
        // $fake  = Faker\Factory::create();
        // $limit = 5;

        // for ($i = 0; $i < $limit; $i++){
        //     DB::table('topping')->insert([
        //         'Name' => $fake->name,
        //         'Price' => 	$fake->numerify($string ='###'),
        //         'Status' => $fake->sentence
        //     ]);
        // }

        //Add datafile
        //category
        DB::table('category')->insert([
        	'Name'=>'Cà Phê',
            'Image'=>'caphe.jpg',
            'Count'=>7
        ]);
        DB::table('category')->insert([
        	'Name'=>'Trà Tươi',
            'Image'=>'tratuoi.jpg',
            'Count'=>6
        ]);
        DB::table('category')->insert([
        	'Name'=>'Trà Sữa',
            'Image'=>'trasua.jpg',
            'Count'=>3
        ]);
        DB::table('category')->insert([
        	'Name'=>'Đá Xay',
            'Image'=>'daxay.jpg',
            'Count'=>4
        ]);
        DB::table('category')->insert([
        	'Name'=>'Bánh Ngọt',
            'Image'=>'banhngot.jpg',
            'Count'=>7
        ]);
        DB::table('category')->insert([
        	'Name'=>'Bánh Mặn',
            'Image'=>'banhman.jpg',
            'Count'=>4
        ]);

        //product
        DB::table('product')->insert([
        	'Name'=>'Espresso / Americano',
            'Image'=> 'espresso.jpeg',
            'Description'=>'Classical Coffee',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Latte / Cappucino',
            'Image'=>'latte.jpg',
            'Description'=>'Classical Coffee',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Mocha / Caramel Macchiato',
            'Image'=>'mocha.jpg',
            'Description'=>'Classical Coffee',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Cà Phê Đen',
            'Image'=>'cpd.jpg',
            'Description'=>'Vietnamese Coffee',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Cà Phê Sữa',
            'Image'=>'cps.jpeg',
            'Description'=>'Vietnamese Coffee With Condensed Milk',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bạc Xỉu',
            'Image'=>'bacxiu.jpg',
            'Description'=>'Vietnamese White Coffee',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Phin',
            'Image'=>'phin.jpg',
            'Description'=>'PHIN Coffee',
        	'Visibility'=>'Delete',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Trà Oolong',
            'Image'=>'oolong.jpg',
            'Description'=>'Oolong Tea',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Trà Đen',
            'Image'=>'blacktea.jpg',
            'Description'=>'Black Tea',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Trà Xanh',
            'Image'=>'greentea.jpg',
            'Description'=>'Green Tea',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Trà Lài',
            'Image'=>'jasminetea.jpg',
            'Description'=>'Jasmine Tea',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Trà Đào Cam Sả',
            'Image'=>'peachtea.jpg',
            'Description'=>'Peach Tea Mania',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Trà Sen',
            'Image'=>'lotustea.jpg',
            'Description'=>'Lotus Tea',
        	'Visibility'=>'Hidden',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Trà Sữa',
            'Image'=>'milktea.jpg',
            'Description'=>'Milk Tea',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Trà Sữa Matcha',
            'Image'=>'matchamt.jpg',
            'Description'=>'Matcha Milk Tea',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Trà Sữa Dâu',
            'Image'=>'strawberrymt.jpg',
            'Description'=>'Strawberry Milk Tea',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Cà Phê Đá Xay',
            'Image'=>'coffeefre.jpg',
            'Description'=>'Coffee Freeze',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Matcha Đá Xay',
            'Image'=>'matchafre.jpg',
            'Description'=>'Matcha Freeze',
        	'Visibility'=>'Out-Stock',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Socola Đá Xay',
            'Image'=>'socolafre.jpg',
            'Description'=>'Socola Freeze',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Caramel Đá Xay',
            'Image'=>'caramelfre.jpg',
            'Description'=>'Caramel Freeze',
        	'Visibility'=>'Out-Stock',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Tiramisu',
            'Image'=>'tiramisu.jpg',
            'Description'=>'Tiramisu Cake',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Socola',
            'Image'=>'socolacake.jpg',
            'Description'=>'Socola Cake',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Dâu',
            'Image'=>'strawberrycake.jpg',
            'Description'=>'Strawberry Cake',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Matcha',
            'Image'=>'matchacake.jpg',
            'Description'=>'Matcha Cake',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Phô Mai Socola',
            'Image'=>'socolacake.jpg',
            'Description'=>'Socola Cheese Cake',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Phô Mai Dâu',
            'Image'=>'strawberrycake.jpg',
            'Description'=>'Strawberry Cheese Cake',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Phô Mai Matcha',
            'Image'=>'matchacake.jpg',
            'Description'=>'Matcha Cheese Cake',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Mì Thịt Nguội',
            'Image'=>'banhmi.jpeg',
            'Description'=>'Ham + Vietnamese Bread',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Mì Gà Xé',
            'Image'=>'banhmi.jpeg',
            'Description'=>'Shredded Chicken + Vietnamese Bread',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Mì Xíu Mại',
            'Image'=>'banhmi.jpeg',
            'Description'=>'Vietnamese Meatball + Vietnamese Bread',
        	'Visibility'=>'Publish',
        ]);
        DB::table('product')->insert([
        	'Name'=>'Bánh Mì Cá Ngừ',
            'Image'=>'banhmi.jpeg',
            'Description'=>'Tuna + Vietnamese Bread',
        	'Visibility'=>'Publish',
        ]);
        
        //product_size
        DB::table('product_size')->insert([
            'Id_Product'=>1,
            'Size'=>'S',
            'Price'=>35000,
            'Sale_Price'=> 35000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>1,
            'Size'=>'M',
            'Price'=>40000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>1,
            'Size'=>'L',
            'Price'=>45000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>2,
            'Size'=>'S',
            'Price'=>60000,
            'Sale_Price'=>55000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>2,
            'Size'=>'M',
            'Price'=>65000,
            'Sale_Price'=>60000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>2,
            'Size'=>'L',
            'Price'=>70000,
            'Sale_Price'=>65000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>3,
            'Size'=>'S',
            'Price'=>60000,
            'Sale_Price'=>55000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>3,
            'Size'=>'M',
            'Price'=>65000,
            'Sale_Price'=>65000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>3,
            'Size'=>'L',
            'Price'=>70000,
            'Sale_Price'=>70000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>4,
            'Size'=>'S',
            'Price'=>35000,
            'Sale_Price'=>35000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>4,
            'Size'=>'M',
            'Price'=>40000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>4,
            'Size'=>'L',
            'Price'=>45000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>5,
            'Size'=>'S',
            'Price'=>35000,
            'Sale_Price'=>35000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>5,
            'Size'=>'M',
            'Price'=>40000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>5,
            'Size'=>'L',
            'Price'=>45000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>6,
            'Size'=>'S',
            'Price'=>35000,
            'Sale_Price'=>35000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>6,
            'Size'=>'M',
            'Price'=>40000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>6,
            'Size'=>'L',
            'Price'=>45000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>7,
            'Size'=>'S',
            'Price'=>35000,
            'Sale_Price'=>35000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>7,
            'Size'=>'M',
            'Price'=>40000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>7,
            'Size'=>'L',
            'Price'=>45000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>8,
            'Size'=>'S',
            'Price'=>45000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>8,
            'Size'=>'M',
            'Price'=>50000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>8,
            'Size'=>'L',
            'Price'=>55000,
            'Sale_Price'=>50000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>9,
            'Size'=>'S',
            'Price'=>45000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>9,
            'Size'=>'M',
            'Price'=>50000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>9,
            'Size'=>'L',
            'Price'=>55000,
            'Sale_Price'=>50000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>10,
            'Size'=>'S',
            'Price'=>45000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>10,
            'Size'=>'M',
            'Price'=>50000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>10,
            'Size'=>'L',
            'Price'=>55000,
            'Sale_Price'=>50000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>11,
            'Size'=>'S',
            'Price'=>45000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>11,
            'Size'=>'M',
            'Price'=>50000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>11,
            'Size'=>'L',
            'Price'=>55000,
            'Sale_Price'=>50000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>12,
            'Size'=>'S',
            'Price'=>45000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>12,
            'Size'=>'M',
            'Price'=>50000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>12,
            'Size'=>'L',
            'Price'=>55000,
            'Sale_Price'=>50000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>13,
            'Size'=>'S',
            'Price'=>45000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>13,
            'Size'=>'M',
            'Price'=>50000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>13,
            'Size'=>'L',
            'Price'=>55000,
            'Sale_Price'=>50000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>14,
            'Size'=>'S',
            'Price'=>55000,
            'Sale_Price'=>55000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>14,
            'Size'=>'M',
            'Price'=>60000,
            'Sale_Price'=>60000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>14,
            'Size'=>'L',
            'Price'=>65000,
            'Sale_Price'=>65000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>15,
            'Size'=>'S',
            'Price'=>55000,
            'Sale_Price'=>55000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>15,
            'Size'=>'M',
            'Price'=>60000,
            'Sale_Price'=>60000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>15,
            'Size'=>'L',
            'Price'=>65000,
            'Sale_Price'=>65000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>16,
            'Size'=>'S',
            'Price'=>55000,
            'Sale_Price'=>55000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>16,
            'Size'=>'M',
            'Price'=>60000,
            'Sale_Price'=>60000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>16,
            'Size'=>'L',
            'Price'=>65000,
            'Sale_Price'=>65000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>17,
            'Size'=>'S',
            'Price'=>60000,
            'Sale_Price'=>60000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>17,
            'Size'=>'M',
            'Price'=>70000,
            'Sale_Price'=>70000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>17,
            'Size'=>'L',
            'Price'=>75000,
            'Sale_Price'=>75000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>18,
            'Size'=>'S',
            'Price'=>60000,
            'Sale_Price'=>60000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>18,
            'Size'=>'M',
            'Price'=>70000,
            'Sale_Price'=>70000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>18,
            'Size'=>'L',
            'Price'=>75000,
            'Sale_Price'=>75000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>19,
            'Size'=>'S',
            'Price'=>60000,
            'Sale_Price'=>60000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>19,
            'Size'=>'M',
            'Price'=>70000,
            'Sale_Price'=>70000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>19,
            'Size'=>'L',
            'Price'=>75000,
            'Sale_Price'=>75000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>20,
            'Size'=>'S',
            'Price'=>60000,
            'Sale_Price'=>60000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>20,
            'Size'=>'M',
            'Price'=>70000,
            'Sale_Price'=>70000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>20,
            'Size'=>'L',
            'Price'=>75000,
            'Sale_Price'=>75000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>21,
            'Size'=>'None',
            'Price'=>40000,
            'Sale_Price'=>35000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>21,
            'Size'=>'None',
            'Price'=>40000,
            'Sale_Price'=>35000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>22,
            'Size'=>'None',
            'Price'=>45000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>23,
            'Size'=>'None',
            'Price'=>45000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>24,
            'Size'=>'None',
            'Price'=>45000,
            'Sale_Price'=>40000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>25,
            'Size'=>'None',
            'Price'=>50000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>26,
            'Size'=>'None',
            'Price'=>50000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>27,
            'Size'=>'None',
            'Price'=>50000,
            'Sale_Price'=>45000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>28,
            'Size'=>'None',
            'Price'=>35000,
            'Sale_Price'=>32000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>29,
            'Size'=>'None',
            'Price'=>35000,
            'Sale_Price'=>32000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>30,
            'Size'=>'None',
            'Price'=>35000,
            'Sale_Price'=>32000,
        ]);
        DB::table('product_size')->insert([
            'Id_Product'=>31,
            'Size'=>'None',
            'Price'=>35000,
            'Sale_Price'=>32000,
        ]);

        //product_category
        DB::table('product_category')->insert([
        	'Id_Category'=>1,
        	'Id_Product'=>1,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>1,
        	'Id_Product'=>2,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>1,
        	'Id_Product'=>3,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>1,
        	'Id_Product'=>4,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>1,
        	'Id_Product'=>5,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>1,
        	'Id_Product'=>6,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>1,
        	'Id_Product'=>7,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>2,
        	'Id_Product'=>8,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>2,
        	'Id_Product'=>9,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>2,
        	'Id_Product'=>10,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>2,
        	'Id_Product'=>11,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>2,
        	'Id_Product'=>12,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>2,
        	'Id_Product'=>13,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>3,
        	'Id_Product'=>14,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>3,
        	'Id_Product'=>15,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>3,
        	'Id_Product'=>16,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>4,
        	'Id_Product'=>17,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>4,
        	'Id_Product'=>18,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>4,
        	'Id_Product'=>19,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>4,
        	'Id_Product'=>20,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>5,
        	'Id_Product'=>21,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>5,
        	'Id_Product'=>22,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>5,
        	'Id_Product'=>23,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>5,
        	'Id_Product'=>24,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>5,
        	'Id_Product'=>25,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>5,
        	'Id_Product'=>26,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>5,
        	'Id_Product'=>27,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>6,
        	'Id_Product'=>28,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>6,
        	'Id_Product'=>29,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>6,
        	'Id_Product'=>30,
        ]);
        DB::table('product_category')->insert([
        	'Id_Category'=>6,
        	'Id_Product'=>31,
        ]);

        //statistical
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>1,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>2,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>3,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>4,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>5,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>6,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>7,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>8,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>9,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>10,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>11,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>12,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>13,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>14,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>15,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>16,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>17,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>18,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>19,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>20,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>21,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>22,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>23,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>24,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>25,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>26,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>27,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>28,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>29,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>30,
        ]);
        DB::table('statistical')->insert([
        	'Purchase'=>0,
        	'Id_Product'=>31,
        ]);

        

        //topping
        DB::table('topping')->insert([
        	'Name'=>'Trân Châu Đen',
        	'Price'=>5000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Trân Châu Trắng',
        	'Price'=>5000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Trân Châu Hoàng Kim',
        	'Price'=>5000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Thạch Rau Câu Vị Cà Phê',
        	'Price'=>8000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Thạch Rau Câu Vị Dâu',
        	'Price'=>8000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Thạch Rau Câu Vị Matcha',
        	'Price'=>8000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Hạt Thủy Tinh Nguyên Vị',
        	'Price'=>8000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Hạt Thủy Tinh Vị Dâu',
        	'Price'=>8000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Hạt Thủy Tinh Vị Cam',
        	'Price'=>8000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Thạch Pudding Trứng',
        	'Price'=>10000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Thạch Pudding Phô Mai',
        	'Price'=>10000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Thạch Pudding Trái Cây',
        	'Price'=>10000,
        	'Status'=>'Còn hàng',
        ]);
        DB::table('topping')->insert([
        	'Name'=>'Bánh Flan',
        	'Price'=>15000,
        	'Status'=>'Còn hàng',
        ]);
        
        //customer_account
        DB::table('customer_account')->insert([
        	'Phone'=>'081412',
        	'Password'=>'123',
        ]);
        DB::table('customer_account')->insert([
        	'Phone'=>'741780',
        	'Password'=>'123',
        ]);
        DB::table('customer_account')->insert([
        	'Phone'=>'384921',
        	'Password'=>'123',
        ]);
        DB::table('customer_account')->insert([
        	'Phone'=>'123123',
        	'Password'=>'123',
        ]);

        //customer_detail
        DB::table('customer_detail')->insert([
        	'Phone'=>'081412',
        	'Name'=>'Tài',
            'Birthday'=>'1999-02-24',
            'Email'=>'taivuongduy2@gmail.com',
        ]);
        DB::table('customer_detail')->insert([
        	'Phone'=>'741780',
        	'Name'=>'Khoa',
            'Birthday'=>'1999-10-10',
            'Email'=>'ohwhynotme1999@gmail.com',
        ]);
        DB::table('customer_detail')->insert([
        	'Phone'=>'384921',
        	'Name'=>'Ân',
            'Birthday'=>'1999-05-01',
            'Email'=>'an.nt.techdev@gmail.com',
        ]);
        DB::table('customer_detail')->insert([
        	'Phone'=>'123123',
        	'Name'=>'Nhã',
            'Birthday'=>'1999-11-18',
            'Email'=>'nha1999@gmail.com',
        ]);

        //loyalty
        DB::table('loyalty')->insert([
            'Phone'=>'081412',
            'Level'=>'Vàng',
            'Point' =>'1888',
            'Discount_Loyalty' => '5',
        ]);
        DB::table('loyalty')->insert([
            'Phone'=>'741780',
            'Level'=>'Bạch Kim',
            'Point' =>'4675',
            'Discount_Loyalty' => '10',
        ]);
        DB::table('loyalty')->insert([
            'Phone'=>'384921',
            'Level'=>'Bạc',
            'Point' =>'890',
            'Discount_Loyalty' => '0',
        ]);
        DB::table('loyalty')->insert([
            'Phone'=>'123123',
            'Level'=>'Đồng',
            'Point' =>'50',
            'Discount_Loyalty' => '0',
        ]);

       //coupon
       DB::table('coupon')->insert([
        'Id'=>'Default',
        'Type'=>'Percent',
        'Value'=>0,
        'Description'=>'Voucher Mặc Định - 0%',
        'Started_at'=>'2020-10-27',
        'Ended_at'=>'2020-10-31',
        ]);
        DB::table('coupon')->insert([
            'Id'=>'Sale50',
            'Type'=>'Percent',
            'Value'=>50,
            'Description'=>'Giảm 50%',
            'Started_at'=>'2020-10-27',
            'Ended_at'=>'2020-10-31',
        ]);
        DB::table('coupon')->insert([
            'Id'=>'Sale30',
            'Type'=>'Percent',
            'Value'=>30,
            'Description'=>'Giảm 30%',
            'Started_at'=>'2020-10-27',
            'Ended_at'=>'2020-10-31',
        ]);
        DB::table('coupon')->insert([
            'Id'=>'Sale50k',
            'Type'=>'Fixed',
            'Value'=>50000,
            'Description'=>'Giảm 50.000 vnđ',
            'Started_at'=>'2020-10-27',
            'Ended_at'=>'2020-10-31',
        ]);
        DB::table('coupon')->insert([
            'Id'=>'Sale30k',
            'Type'=>'Fixed',
            'Value'=>30000,
            'Description'=>'Giảm 30.000 vnđ',
            'Started_at'=>'2020-10-27',
            'Ended_at'=>'2020-10-31',
        ]);
        DB::table('coupon')->insert([
            'Id'=>'1',
            'Type'=>'Percent',
            'Value'=>30,
            'Description'=>'Giảm 30%',
            'Started_at'=>'2020-10-27',
            'Ended_at'=>'2020-11-13',
        ]);
        DB::table('coupon')->insert([
            'Id'=>'2',
            'Type'=>'Fixed',
            'Value'=>30000,
            'Description'=>'Giảm 30k',
            'Started_at'=>'2020-10-27',
            'Ended_at'=>'2020-11-13',
        ]);

        //payment_method
        DB::table('payment_method')->insert([
            'Name'=>'Thanh Toán Trực Tiếp',
            'Status'=>'Hỗ trợ',
        ]);
        DB::table('payment_method')->insert([
            'Name'=>'Thanh Toán Qua Thẻ Tín Dụng',
            'Status'=>'Hỗ trợ',
        ]);
        DB::table('payment_method')->insert([
            'Name'=>'Thanh Toán Qua Ví Điện Tử Paypal',
            'Status'=>'Hỗ trợ',
        ]);
        DB::table('payment_method')->insert([
            'Name'=>'Thanh Toán Qua Ví Điện Tử Momo',
            'Status'=>'Hỗ trợ',
        ]);
        DB::table('payment_method')->insert([
            'Name'=>'Thanh Toán Qua Ví Điện Tử Zalopay',
            'Status'=>'Không hỗ trợ',
        ]);
        
    }
}

/* Auto add datafiles
php artisan db:seed --class=DatabaseSeeder
*/

/*
php artisan migrate:rollback
php artisan migrate
php artisan db:seed --class=DatabaseSeeder
php artisan serve
*/

/*
php artisan migrate:refresh
php artisan db:seed --class=DatabaseSeeder
php artisan serve
*/
