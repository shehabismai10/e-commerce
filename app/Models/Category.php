<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    //
    protected $fillable=[
        'name',
        'slug',
        'description',
        'image',
        'parent_id',

    ];

    
    // Define the relationship between categories and subcategories
    public function parent(){   
        return $this->belongsTo(Category::class,'parent_id');
        
    }
    // Define the relationship for subcategories (children)
    public function subcategories(){
        return $this->hasMany(Category::class,'parent_id');
    }
    //creating slugs
    public function setSlugAttribute($value){
        $this->attributes['slug']= Str::slug($value);       
    }

    // Optionally, an accessor to get the image URL if stored in the public directory
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    
}
