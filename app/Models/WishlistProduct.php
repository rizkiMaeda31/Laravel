<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WishlistProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['wishlistId','productId'];
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'api'=>'json'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->uuid=Str::uuid();
            $defaultApi = [
                'uuid'=>$user->uuid,
                'wishlistId'=>$user->wishlistId,
                'productId'=>$user->productId,
            ];
            $user->api = $defaultApi;
        });
        static::created(function($user){
            $user->api=array_merge($user->api, [
                'wpId' => $user->id,
                'created_at'=>$user->created_at,
                'updated_at'=>$user->updated_at,
                'deleted_at'=>$user->deleted_at
            ]);    
            $user->save();
        });
        static::softDeleted(function($t){
            $t->api=array_merge($t->api, [
                'deleted_at'=>$t->deleted_at
            ]);
            $t->save();
        });
        static::restoring(function($t){
            $t->api=array_merge($t->api, [
                'deleted_at'=>null
            ]);
            $t->save();
        });
    }
}
