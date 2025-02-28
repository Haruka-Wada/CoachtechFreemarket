<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Item;
use App\Models\Favorite;
use App\Models\Comment;
use App\Models\Order;
use App\Http\Requests\SellRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller {

    public function index(Request $request)
    {
        if($request->session()->has('items')) {
            $items = $request->session()->get('items');
        } else {
            $items = Item::all();
        }
        return view('index', compact('items'));
    }

    public function search()
    {
        $items = Item::query()
            ->when(request('keyword'), function($query){
                $query->where('name', 'like', '%' . request('keyword') . '%')
                    ->orWhereHas('categories', function($query) {
                        $query->where('categories.name', 'like', '%'.request('keyword').'%');
                    });
            })->get();

        $previousUrl = url()->previous();
        if(preg_match('/mylist/', $previousUrl)) {
            return redirect ('/mylist')->with('items', $items);
        }else {
            return redirect('/')->with('items', $items);
        }
    }

    public function mylist(Request $request)
    {
        if($request->session()->has('items')) {
            $items = $request->session()->get('items');
            $item_ids = [];
            foreach($items as $item) {
                array_push($item_ids, $item->id);
            }
            $favorites = Favorite::where('user_id', Auth::id())
                        ->whereIn('item_id', $item_ids)->get();
        } else {
            $favorites = Favorite::where('user_id', Auth::id())->get();
        }

        return view('mylist', compact('favorites'));
    }

    public function detail(Request $request)
    {
        $item = Item::withCount(['favorites', 'comments'])->find($request->item_id);

        return view('detail', compact('item'));
    }

    public function purchase(Request $request)
    {
        $item = Item::find($request->item_id);

        return view('purchase', compact('item'));
    }

    public function favorite(Request $request)
    {
        $user_id = Auth::id();
        $item_id = $request->item_id;
        $already_liked = Favorite::where('user_id', $user_id)->where('item_id', $item_id)->first();

        if (!$already_liked) {
            $favorite = Favorite::create([
                'user_id' => $user_id,
                'item_id' => $item_id
            ]);
        } else {
            $already_liked->delete();
        }

        $favorites_counter = Item::withCount('favorites')->find($item_id)->favorites_count;
        $param = [
            'item_favorite_count' => $favorites_counter
        ];

        return response()->json($param);
    }

    public function mypage()
    {
        $items = Item::all();
        $sell_items = Item::where('user_id', Auth::id())->get();
        $orders = Order::where('user_id', Auth::id())
                        ->where('payment_status', '!=', 'expired')->get();
        return view('mypage', compact('items', 'sell_items', 'orders'));
    }

    //出品ページ
    public function sell()
    {
        $conditions = Condition::all();
        $categories = Category::all();

        return view('sell', compact('conditions', 'categories'));
    }

    //出品登録
    public function store(SellRequest $request)
    {
        $image = $request->file('image');
        $path = $image->store('image', 'public');
        $full_path = asset('storage/' . $path);

        $item = Item::create([
            'condition_id' => $request->condition_id,
            'name' => $request->name,
            'image' => $full_path,
            'brand' => $request->brand,
            'price' => $request->price,
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        $item->categories()->sync($request->category_ids);

        return redirect('/mypage');
    }

    //コメントページ
    public function comment(Request $request)
    {
        $item = Item::withCount(['favorites', 'comments'])->find($request->item_id);
        $comments = Comment::with('user')->where('item_id', $item->id)->get();

        return view('comment', compact('item', 'comments'));
    }

    //コメント投稿
    public function post(CommentRequest $request)
    {
        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'item_id' => $request->item_id
        ]);

        return back();
    }

    //コメント削除
    public function delete(Request $request)
    {
        Comment::find($request->comment_id)->delete();

        return back();
    }

}
