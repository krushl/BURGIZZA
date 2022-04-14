<?php

namespace App\Http\Controllers;

use App\Models\AddIngredients;
use App\Models\Article;
use App\Models\Burger;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    protected const UPLOAD_PATH_BURGERS = 'public/img/burgers';
    protected const UPLOAD_PATH_ARTICLES = 'public/img/articles';

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

        if ($request->file('burgerPic')) {
            $file = $request->file('burgerPic');
            $filename = time() . $file->getClientOriginalName();

            Storage::putFileAs(self::UPLOAD_PATH_BURGERS, $file, $filename);
            $burgerImage = $filename;
        }

        $composition = json_encode($request->composition);
        $burger = Burger::create([
            'name' => $request->burgerName,
            'price' => $request->price,
            'composition' => $composition,
            'image' => $burgerImage,
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


            if ($request->file('burgerPic')) {
                $file = $request->file('burgerPic');
                $filename = time() . $file->getClientOriginalName();

                $path = self::UPLOAD_PATH_BURGERS . $burger->image;
                Storage::delete($path);

                Storage::putFileAs(self::UPLOAD_PATH_BURGERS, $file, $filename);
                $burger->image = $filename;

                if (!$burger->save()) {
                    return abort(400, 'beda');
                }
            }


        if ($burger) {
            $composition = json_encode($request->composition);
            $burger->name = $request->burgerName;
            $burger->price = $request->price;
            $burger->composition = $composition ?? $burger->composition;
            $burger->category_id = $request->category;
            $burger->image = $filename ?? $burger->image;

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
        $path = self::UPLOAD_PATH_BURGERS . '/' . $burger->image;

        if (Storage::delete($path)) {
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

    public function articlesIndex()
    {
        $articles = Article::all();

        return view('admin.article.index',compact('articles'));
    }

    public function articlesAddForm()
    {
        return view('admin.article.add');
    }

    public function articlesEditForm(Request $request)
    {
        $article = Article::find($request->articleId);


        return view('admin.article.edit',compact('article'));
    }

    public function articlesAdd(Request $request)
    {
        if ($request->file('articleImage')) {
            $file = $request->file('articleImage');
            $filename = time() . $file->getClientOriginalName();

            Storage::putFileAs(self::UPLOAD_PATH_ARTICLES, $file, $filename);

        }


        $article = Article::create([
            'title' => $request->articleTitle,
            'content' => $request->articleContent,
            'image' => $filename ?? 'default.jpg',
            'date' => (new DateTime())->format('d-m-Y'),
        ]);

        if (!$article->save()) {
            return abort(400, 'Что то пошло не так');
        }

        return redirect()->route('admin.articles.index');
    }

    public function articlesEdit(Request $request)
    {
        $article = Article::find($request->articleId);

        if ($request->file('articleImage')) {
            $file = $request->file('articleImage');
            $filename = time() . $file->getClientOriginalName();

            $path = self::UPLOAD_PATH_ARTICLES . $article->image;
            Storage::delete($path);

            Storage::putFileAs(self::UPLOAD_PATH_ARTICLES, $file, $filename);
        }


        if ($article) {
            $article->title = $request->articleTitle;
            $article->content = $request->articleContent;
            $article->image = $filename ?? $article->image;

            if (!$article->save()) {
                return abort(400, 'Что то пошло не так');
            }
        }

        return redirect()->back();
    }

    public function articlesDestroy(Request $request)
    {
        $article = Article::find($request->articleId);

        if(!$article->delete())
        {
            return ["result"=>false,"message"=>'Произошла ошибка при удалении'];
        }

        return ["result"=>true, "message"=>'Успешно удаленно'];
    }





    public function ingredientsIndex()
    {
        $ingredients = AddIngredients::all();

        return view('admin.ingredients.index',compact('ingredients'));
    }

    public function ingredientsAddForm()
    {
        return view('admin.ingredients.add');
    }

    public function ingredientsEditForm(Request $request)
    {
        $ingredients = AddIngredients::find($request->ingredient_id);


        return view('admin.ingredients.edit',compact('ingredients'));
    }

    public function ingredientsAdd(Request $request)
    {
        $ingredients = AddIngredients::create([
            'ingredient' => $request->ingredient,
        ]);

        if (!$ingredients->save()) {
            return abort(400, 'Что то пошло не так');
        }

        return redirect()->route('admin.ingredients.index');
    }

    public function ingredientsEdit(Request $request)
    {
        $ingredients = AddIngredients::find($request->ingredients_id);

        if ($ingredients) {
            $ingredients->ingredient = $request->ingredient;

            if (!$ingredients->save()) {
                return abort(400, 'Что то пошло не так');
            }
        }

        return redirect()->route('admin.ingredients.index');
    }

    public function ingredientsDestroy(Request $request)
    {
        $ingredients = AddIngredients::find($request->id);

        if(!$ingredients->delete())
        {
            return ["result"=>false,"message"=>'Произошла ошибка при удалении'];
        }

        return ["result"=>true, "message"=>'Успешно удаленно'];
    }


    public function ordersIndex()
    {
        $orders = Order::with('burgers')->whereNotNull('status_id')->get();
        $statuses = OrderStatus::all();
        return view('admin.orders.index',compact('orders','statuses'));
    }
    public function orderChange(Request $request)
    {
        Order::where(['id'=>$request->orderId])->update(['status_id'=>$request->statusId]);
        return ['result'=>true, 'message'=>'Статус заказа обновлен'];
    }
}
