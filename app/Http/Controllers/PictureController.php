<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePictureRequest;
use App\Http\Resources\PictureResource;
use App\Models\Picture;

class PictureController extends Controller
{
    public function index()
    {
        $pictures = Picture::all();
        if (!$pictures) {
            return response()->json(["Error" => "No picture found"], 404);
        }
        return response()->json(PictureResource::collection($pictures), 200);
    }

    public function show($id)
    {
        $picture = Picture::find($id);
        if ($picture) {
            return response()->json(new PictureResource($picture), 200);
        }
        return response()->json(["Error" => "Picture not found"], 404);
    }
    public function store(StorePictureRequest $request)
    {
        $validate = $request->validated();
        $image = $validate->file('image');
        $picture = new Picture();
        $picture->name = $image->getPath();
        $validate["image"]->move(public_path('images'), $picture->name);
        $picture->product_id = $validate["product_id"];
        $picture->save();
        return response()->json(["Message" => "Picture was added"], 200);
    }
    public function update(StorePictureRequest $request, $id)
    {
        $validate = $request->validated();
        $picture = Picture::find($id);
        if ($picture) {
            $picture->name = time() . '.' . $validate["image"]->extension();
            $validate["image"]->move(public_path('images'), $picture->name);
            $picture->product_id = $validate["product_id"];
            $picture->image = 'images/' . $picture->name;
            $picture->update();
            return response()->json(["Message" => "Picture was updated"], 200);
        } else {
            return response()->json(["Error" => "Picture not found"], 404);
        }
    }

    public function delete($id)
    {
        $picture = Picture::find($id);
        if ($picture) {
            $picture->delete();
            return response()->json(["Message" => "Picture was deleted"], 200);
        }
        return response()->json(["Error" => "Picture not found"], 404);

    }
}
