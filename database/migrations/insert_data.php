<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Log;
use App\Models\Wishlist;
use App\Models\WishlistProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {        
        $log=new Log();
        $role = new Role();
        $role->name='super admin';
        $role->save();
        $log->task='create role '.$role->name;
        $log->status='Create Role is Success';
        $log->detail=json_encode($role->api);
        $log->save();
        $role = new Role();
        $log=new Log();
        $role->name='admin';
        $role->save();
        $log->task='create role '.$role->name;
        $log->status='Create Role is Success';
        $log->detail=json_encode($role->api);
        $log->save();
        $role = new Role();
        $log=new Log();
        $role->name='manager';
        $role->save();
        $log->task='create role '.$role->name;
        $log->status='Create Role is Success';
        $log->detail=json_encode($role->api);
        $log->save();
        $role = new Role();
        $log=new Log();
        $role->name='guest';
        $role->save();
        $log->task='create role '.$role->name;
        $log->status='Create Role is Success';
        $log->detail=json_encode($role->api);
        $log->save();

        $user=new User();
        $log=new Log();
        $user->name='super admin';
        $user->email='superadmin@email.com';
        $user->roleId=1;
        $user->password = Hash::make('root');
        $user->created_at=now();
        $user->save();
        $log->task='create user '.$user->name;
        $log->status='Create User is Success';
        $log->detail=json_encode($user->api);
        $log->save();

        $user=new User();
        $log=new Log();
        $user->name='admin';
        $user->email='admin@email.com';
        $user->roleId=2;
        $user->password = Hash::make('admin');
        $user->created_at=now();
        $user->save();
        $log->task='create user '.$user->name;
        $log->status='Create User is Success';
        $log->detail=json_encode($user->api);
        $log->save();

        $user=new User();
        $log=new Log();
        $user->name='manager';
        $user->email='manager@email.com';
        $user->roleId=3;
        $user->password = Hash::make('manager');
        $user->created_at=now();
        $user->save();
        $log->task='create user '.$user->name;
        $log->status='Create User is Success';
        $log->detail=json_encode($user->api);
        $log->save();
        $vgas = [
            ['name' => 'NVIDIA GeForce RTX 3080', 'brand' => 'NVIDIA', 'isPublished'=> rand(0, 1)],
            ['name' => 'AMD Radeon RX 6800 XT', 'brand' => 'AMD', 'isPublished'=> rand(0, 1)],
            ['name' => 'NVIDIA GeForce GTX 1660 Ti', 'brand' => 'NVIDIA', 'isPublished'=> rand(0, 1)],
            ['name' => 'AMD Radeon RX 5700 XT', 'brand' => 'AMD', 'isPublished'=> rand(0, 1)],
            ['name' => 'NVIDIA Quadro P5000', 'brand' => 'NVIDIA', 'isPublished'=> rand(0, 1)],
            ['name' => 'NVIDIA GeForce RTX 4090', 'brand' => 'NVIDIA', 'isPublished'=> rand(0, 1)],
            ['name' => 'AMD Radeon RX 7900 XTX', 'brand' => 'AMD', 'isPublished'=> rand(0, 1)],
            ['name' => 'NVIDIA GeForce RTX 4080', 'brand' => 'NVIDIA', 'isPublished'=> rand(0, 1)],
            ['name' => 'AMD Radeon RX 7900 XT', 'brand' => 'AMD', 'isPublished'=> rand(0, 1)],
            ['name' => 'NVIDIA GeForce RTX 4070 Ti', 'brand' => 'NVIDIA', 'isPublished'=> rand(0, 1)],
            ['name' => 'NVIDIA GeForce RTX 3090 Ti', 'brand' => 'NVIDIA', 'isPublished'=> rand(0, 1)],
            ['name' => 'AMD Radeon RX 6950 XT', 'brand' => 'AMD', 'isPublished'=> rand(0, 1)],
            ['name' => 'AMD Radeon 6900 XT', 'brand' => 'AMD', 'isPublished'=> rand(0, 1)],
            ['name' => 'NVIDIA GeForce RTX 3080 Ti', 'brand' => 'NVIDIA', 'isPublished'=> rand(0, 1)],
            ['name' => 'AMD Radeon RX 6800', 'brand' => 'AMD', 'isPublished'=> rand(0, 1)],
            ['name' => 'NVIDIA Titan V', 'brand' => 'NVIDIA', 'isPublished'=> rand(0, 1)],
            ['name' => 'AMD Radeon RX 6700 XT', 'brand' => 'AMD', 'isPublished'=> rand(0, 1)],
            
        ];
        
        $processors = [
            ['name' => 'Intel Core i9-9900K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 9 5950X', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
            ['name' => 'Intel Core i7-10700K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 7 5800X', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
            ['name' => 'Intel Core i5-10600K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 5 5600X', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
            ['name' => 'Intel Core i9-10900K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 9 5900X', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
            ['name' => 'Intel Core i7-9700K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 7 3700X', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
            ['name' => 'Intel Core i5-9600K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 5 3600X', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
            ['name' => 'Intel Core i9-11900K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 9 3950X', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
            ['name' => 'Intel Core i7-11700K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 7 3800X', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
            ['name' => 'Intel Core i5-11600K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 5 5600G', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
            ['name' => 'Intel Core i9-12900K', 'brand' => 'Intel', 'isPublished' => rand(0, 1)],
            ['name' => 'AMD Ryzen 9 6900X', 'brand' => 'AMD', 'isPublished' => rand(0, 1)],
        ];

        $motherboards=[
            ['name' => 'ASUS ROG Strix B550-F Gaming', 'brand' => 'ASUS', 'isPublished' => rand(0, 1)],
            ['name' => 'GIGABYTE B450 AORUS PRO', 'brand' => 'GIGABYTE', 'isPublished' => rand(0, 1)],
            ['name' => 'MSI MPG B550 GAMING PLUS', 'brand' => 'MSI', 'isPublished' => rand(0, 1)],
            ['name' => 'ASRock B450M PRO4', 'brand' => 'ASRock', 'isPublished' => rand(0, 1)],
            ['name' => 'ASUS TUF Gaming X570-Plus', 'brand' => 'ASUS', 'isPublished' => rand(0, 1)],
            ['name' => 'GIGABYTE Z390 AORUS PRO WIFI', 'brand' => 'GIGABYTE', 'isPublished' => rand(0, 1)],
            ['name' => 'MSI MAG B550 TOMAHAWK', 'brand' => 'MSI', 'isPublished' => rand(0, 1)],
            ['name' => 'ASRock B450 Steel Legend', 'brand' => 'ASRock', 'isPublished' => rand(0, 1)],
            ['name' => 'ASUS Prime B450M-A/CSM', 'brand' => 'ASUS', 'isPublished' => rand(0, 1)],
            ['name' => 'GIGABYTE B550 AORUS PRO', 'brand' => 'GIGABYTE', 'isPublished' => rand(0, 1)],
            ['name' => 'MSI B450 TOMAHAWK MAX', 'brand' => 'MSI', 'isPublished' => rand(0, 1)],
            ['name' => 'ASRock X570 Phantom Gaming 4', 'brand' => 'ASRock', 'isPublished' => rand(0, 1)],
            ['name' => 'ASUS ROG Strix Z390-E Gaming', 'brand' => 'ASUS', 'isPublished' => rand(0, 1)],
            ['name' => 'GIGABYTE X570 AORUS ELITE', 'brand' => 'GIGABYTE', 'isPublished' => rand(0, 1)],
            ['name' => 'MSI B450M Mortar MAX', 'brand' => 'MSI', 'isPublished' => rand(0, 1)],
            ['name' => 'ASRock B550M Steel Legend', 'brand' => 'ASRock', 'isPublished' => rand(0, 1)],
            ['name' => 'ASUS ROG Crosshair VIII Hero', 'brand' => 'ASUS', 'isPublished' => rand(0, 1)],
            ['name' => 'GIGABYTE Z490 AORUS PRO AX', 'brand' => 'GIGABYTE', 'isPublished' => rand(0, 1)],
            ['name' => 'MSI MAG X570 TOMAHAWK WIFI', 'brand' => 'MSI', 'isPublished' => rand(0, 1)],
            ['name' => 'ASRock B450M-HDV R4.0', 'brand' => 'ASRock', 'isPublished' => rand(0, 1)],
        ];
        
        $categories = [
            ['name' => 'GPU'],
            ['name' => 'Processor'],
            ['name' => 'Motherboard'],
            ['name' => 'Monitor'],
            ['name' => 'Accessories'],
        ];
        $wishlist=[
            ['name' => 'myvga', 'userId' => 1, 'content' => [
                ['productId' => 1,'wishlistId' => 1],
                ['productId' => 2,'wishlistId' => 1]
            ]]
        ];
        
        $this->dumpCategory($categories);
        $this->dumpProduct($vgas,1);
        $this->dumpProduct($processors,2);
        $this->dumpProduct($motherboards,3);
        $this->dumpWishlist($wishlist);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }

    public function dumpProduct($arr,$categoryId){
        foreach ($arr as $item) {
            $product=new Product();
            $log=new Log();
            $product->name=$item['name'];
            $product->brand=$item['brand'];
            $product->categoryId=$categoryId;
            $product->isPublished=$item['isPublished'];
            $product->save();
            $log->task='create product '.$product->name;
            $log->status='Create Product is Success';
            $log->detail=json_encode($product->api);
            $log->save();
        }
    }

    public function dumpCategory($arr){
        foreach ($arr as $item) {
            $category=new Category();
            $log=new Log();
            $category->name=$item['name'];
            $category->save();
            $log->task='create category '.$category->name;
            $log->status='Create Category is Success';
            $log->detail=json_encode($category->api);
            $log->save();
        }
    }

    public function dumpWishlist($arr){
        foreach ($arr as $item) {
            $wishlist=new Wishlist();
            $log=new Log();
            $wishlist->name=$item['name'];
            $wishlist->userId=$item['userId'];
            $wishlist->save();
            $log->task='create wishlist '.$wishlist->name;
            $log->status='Create Wishlist is Success';
            $log->detail=json_encode($wishlist->api);
            $log->save();
            foreach ($item['content'] as $content) {
                $wp=new WishlistProduct();
                $wp->wishlistId=$content['wishlistId'];
                $wp->productId=$content['productId'];
                $wp->save();
                $log=new Log();
                $log->task='create product in wishlist 1';
                $log->status='Create product in wishlist is Success';
                $log->detail=json_encode($wp->api);
                $log->save();
            }
        }
    }
};
