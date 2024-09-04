<?php

namespace App\Http\Controllers;

use App\Models\ImageNewsitem;
use Illuminate\Http\Request;

class ImageNewsController extends Controller
{
    public function addImgToItem($news_id, $image_id)
    {
        return ImageNewsitem::create(['news_id'=>$news_id, 'image_id'=>$image_id]);
    }
    public function removeImgFromItem($news_id, $image_id)
    {
        return ImageNewsitem::destroy(['news_id'=>$news_id, 'image_id'=>$image_id]);
    }
}
