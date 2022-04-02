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
            return abort(403, 'Администратор only');
        }

        return view('admin.index');
    }

    public function burgerAddForm()
    {
        if(!Gate::allows('admin'))
        {
            return abort(403, 'Администратор only');
        }
        $burgers = Burger::all();

        return view('admin.burger.add',compact('burgers'));
    }

    public function burgerAdd(Request $request)
    {
        if(!Gate::allows('admin'))
        {
            return abort(403, 'Администратор only');
        }

        $img = new Image;
        if ($request->file('burgerPic')) {
            $file = $request->file('burgerPic');
            $filename = time() . $file->getClientOriginalName();

            Storage::putFileAs(self::UPLOAD_PATH, $file, $filename);
            $img->picture = $filename;

            if(!$img->save()){
                return abort(400, 'Что-то пошло не так');
            }
        }

        $composition = json_encode($request->composition);
        $burger = Burger::create([
            'name' => $request->burgerName,
            'price' => $request->price,
            'composition' => $composition,
            'image_id' => $img->id,
            'category_id' => $request->category,
        ]);

        if(!$burger->save()) {
            return abort(400,$burger->error());
        }

        return $this->burgerAddForm();
    }

    public function burgerEditForm()
    {
        $burgers = Burger::all();
        return view('admin.burger.edit',compact('burgers'));
    }

    public function burgerEdit(Request $request)
    {
        if(!Gate::allows('admin'))
        {
            return abort(403, 'Администратор only');
        }

        $burger = Burger::find($request->id);
        $img = Image::find($burger->image_id);

        if ($img) {
            if ($request->file('burgerPic')) {
                $file = $request->file('burgerPic');
                $filename = time() . $file->getClientOriginalName();

                Storage::putFileAs(self::UPLOAD_PATH, $file, $filename);
                $img->picture = $filename;
                if(!$img->save()){
                    return abort(400, 'beda');
                }
            }
        } else {
            return abort (404,'Не найдено');
        }

        if ($burger) {
            $composition = json_encode($request->composition);
            $burger->name = $request->burgerName;
            $burger->price = $request->price;
            $burger->composition = $composition ;
            $burger->category = $request->category;

            if (!$burger->save()) {
                return abort(400, 'Что то пошло не так');
            }

        } else {
            return abort(404, 'Не найдено');
        }


        return $this->burgerEditForm();
    }
}
