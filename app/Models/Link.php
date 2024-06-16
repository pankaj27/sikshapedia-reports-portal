<?php

namespace App\Models;

//use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Link extends Model
{
    use HasFactory;
    
 
    protected $fillable = ['original_url', 'short_url'];
 
    // public static function shortenUrl($originalUrl)
    // {
    //     $link = self::create(['original_url' => $originalUrl]);
    //     $link->short_url = Hashids::encode($link->id);
    //     $link->save();
 
    //     return $link;
    // }
 
    // public static function getOriginalUrl($shortUrl)
    // {
    //     $linkId = \Hashids::decode($shortUrl);
    //     $link = self::find($linkId);

    //     if(isset($link[0]) && !empty($link[0])){

    //         return $link ? $link[0]->original_url : null;
    //     }
 
    //     return null;
    // }
}
