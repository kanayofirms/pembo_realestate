<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Request;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = ['name'];

    public function stocks(): HasMany
    {
        return $this->hasMany(SubCategoryModel::class, 'category_id');
    }
}
