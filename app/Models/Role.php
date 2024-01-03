<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name'];
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'api'=>'json'
    ];
    public function users():HasMany{
        return $this->hasMany(User::class,'roleId','id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->uuid=Str::uuid();
            $defaultApi = [
                'uuid'=>$user->uuid,
                'name'=>$user->name,
            ];
            $user->api = $defaultApi;
        });
        static::created(function($user){
            $user->api=array_merge($user->api, [
                'roleId' => $user->id,
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
