<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\CustomHelper;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
        'category_slug',
        'created_by',
        'updated_by',
        'is_active'
    ];

    public function media(){
        return $this->hasOne(Media::class,'attr_id')->where(['type' => CustomHelper::CATEGORY,'is_active' => 1]);
    }
}
