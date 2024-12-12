<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function getGenderLabelAttribute()
    {
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        return $genders[$this->gender] ?? '不明';
    }
    

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }
}
