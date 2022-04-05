<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    protected const UPLOAD_PATH = 'public/img/burgers';

    public function adminIndex()
    {
        return view('admin.index');
    }

    public function burgerAddForm()
    {
        $categories = Category::all();
        $burgers = Burger::all();

        return view('admin.burger.add', compact('burgers','categories'));
    }

    public function burgerAdd(Request $request)
    {
        $img = new Image;
        if ($request->file('burgerPic')) {
            $file = $request->file('burgerPic');
            $filename = time() . $file->getClientOriginalName();

            Storage::putFileAs(self::UPLOAD_PATH, $file, $filename);
            $img->picture = $filename;

            if (!$img->save()) {
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

        if (!$burger->save()) {
            return abort(400, $burger->error());
        }

        return redirect()->route('admin.burger.burger-addForm');
    }

    public function burgerEditForm(Request $request)
    {
        $categories = Category::all();
        $burger = Burger::find($request->burgerId);
        return view('admin.burger.edit', compact('burger','categories'));
    }

    public function burgerEdit(Request $request)
    {
        $burger = Burger::find($request->burgerId);

        $img = Image::find($burger->image_id);

        if ($img) {
            if ($request->file('burgerPic')) {
                $file = $request->file('burgerPic');
                $filename = time() . $file->getClientOriginalName();

                $path = self::UPLOAD_PATH . $img->picture;
                Storage::delete($path);

                Storage::putFileAs(self::UPLOAD_PATH, $file, $filename);
                $img->picture = $filename;

                if (!$img->save()) {
                    return abort(400, 'beda');
                }
            }
        }

        if ($burger) {
            $composition = json_encode($request->composition);
            $burger->name = $request->burgerName;
            $burger->price = $request->price;
            $burger->composition = $composition ?? $burger->composition;
            $burger->category_id = $request->category;
            $burger->image_id = $img->id ?? $burger->image_id;

            if (!$burger->save()) {
                return abort(400, 'Что то пошло не так');
            }

        } else {
            return abort(404, 'Не найдено');
        }


        return redirect()->route('admin.burger.burger-addForm');
    }

    public function burgerDestroy(Request $request)
    {
        $burger = Burger::find($request->burgerId);
        $path = self::UPLOAD_PATH . '/' . $burger->image->picture;

        if (!Storage::delete($path)) {
            if (!$burger->delete()) {
                return ['result' => false, 'message' => 'Произошла ошибка при удаление'];
            }
        }

        return ['result' => true, 'message' => 'Успешно удалено'];
    }



    public function categoryIndex()
    {
        $categories = Category::all();

        return view('admin.category.index',compact('categories'));
    }

    public function categoryAddForm()
    {
        return view('admin.category.add');
    }

    public function categoryEditForm(Request $request)
    {
        $category = Category::find($request->category_id);
        return view('admin.category.edit',compact('category'));
    }

    public function categoryAdd(Request $request)
    {
        $category = Category::create([
            'category' => $request->category,
        ]);

        if (!$category->save()) {
            return abort(400, 'Что то пошло не так');
        }

        return redirect()->route('admin.category.index');
    }

    public function categoryEdit(Request $request)
    {
        $category = Category::find($request->category_id);

        if ($category) {
            $category->category = $request->category;

            if (!$category->save()) {
                return abort(400, 'Что то пошло не так');
            }
        }

        return redirect()->route('admin.category.index');
    }

    public function categoryDestroy(Request $request)
    {
        $category = Category::find($request->category_id);

        if(!$category->delete())
        {
            return ["result"=>false,"message"=>'Произошла ошибка при удалении'];
        }

        return ["result"=>true, "message"=>'Успешно удаленно'];
    }

    public function statusIndex()
    {
        $statuses = OrderStatus::all();

        return view('admin.status.index',compact('statuses'));
    }

    public function statusAddForm()
    {
        return view('admin.status.add');
    }

    public function statusEditForm(Request $request)
    {
        $status = OrderStatus::find($request->status_id);


        return view('admin.status.edit',compact('status'));
    }

    public function statusAdd(Request $request)
    {
        $status = OrderStatus::create([
            'status' => $request->status,
        ]);

        if (!$status->save()) {
            return abort(400, 'Что то пошло не так');
        }

        return redirect()->route('admin.status.index');
    }

    public function statusEdit(Request $request)
    {
        $status = OrderStatus::find($request->status_id);

        if ($status) {
            $status->status = $request->status;

            if (!$status->save()) {
                return abort(400, 'Что то пошло не так');
            }
        }

        return redirect()->route('admin.status.index');
    }

    public function statusDestroy(Request $request)
    {
        $status = OrderStatus::find($request->id);

        if(!$status->delete())
        {
            return ["result"=>false,"message"=>'Произошла ошибка при удалении'];
        }

        return ["result"=>true, "message"=>'Успешно удаленно'];
    }
}
