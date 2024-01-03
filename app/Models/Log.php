<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Log extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['task', 'status', 'detail',];
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
                'task'=>$user->task,
                'status'=>$user->status,
                'detail'=>$user->detail,
                'isPublished'=>$user->isPublished,
            ];
            $user->api = $defaultApi;
        });
        static::created(function($user){
            $user->api=array_merge($user->api, [
                'logId' => $user->id,
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
