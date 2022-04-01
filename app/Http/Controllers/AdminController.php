<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    protected const UPLOAD_PATH = 'public/img/burgers';

    public function adminIndex()
    {
        if(!Gate::allows('admin'))
        {
            return abort(403, 'Poshel na ?@! otsudda');
        }

        return view('admin.index');
    }

    public function burgerAddForm()
    {
        if(!Gate::allows('admin'))
        {
            return abort(403, 'Poshel na ?@! otsudda');
        }

        return view('admin.burger.add');
    }

    public function burgerAdd(Request $request)
    {
        if(!Gate::allows('admin'))
        {
            return abort(403, 'Poshel na ?@! otsudda');
        }

        $img = new Image;
        if ($request->file('burgerPic')) {
            $file = $request->file('burgerPic');
            $filename = time() . $file->getClientOriginalName();

            Storage::putFileAs(self::UPLOAD_PATH, $file, $filename);
            $img->picture = $filename;
            if(!$img->save()){
                return abort(400, 'beda');
            }
        }


        $burger = Burger::create([
            'name' => $request->burgerName,
            'price' => $request->price,
            'composition' => $request->composition,
            'image_id' => $img->id,
            'category' => Category::find($request->category_id),
        ]);

        if(!$burger->save) {
            return abort(400,'very bad.. pryam beda...');
        }

        return redirect()->route('burger.index');
    }
}
