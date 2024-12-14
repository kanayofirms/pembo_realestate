<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Request;

class SubCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'sub_category';

    protected $fillable = ['category_id', 'quantity', 'price'];
}
