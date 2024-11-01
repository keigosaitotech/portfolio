<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::sortable()->paginate(5); 
        return view('item.index',compact('items'));
    }

       //商品削除ボタン
    public function destroy(Request $request, Item $item)
    {
        Item::where('id', $request->item_id)->delete();
        return redirect('/items');
    }
 
    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

   
    /**
     * 商品編集
     */
    public function hensyu($id){
        $item=Item::find($id);
        return view('item.hensyu',compact('item'));
    }

     public function henkou(Request $request,$id){
        $request->validate([
            'name'=> 'required|max:100',
            'type'=>'required|max:100',
            'detail'=> 'required|max:200',
        ]);
        $item=Item::find($id);
        $item->name=$request->name;
        $item->type=$request->type;
        $item->detail=$request->detail;
        $item->save();

        return redirect('/items');
    }

    public function kensaku(Request $request)
    {

         /* テーブルから全てのレコードを取得する */
           $items = null;
           /* $items = Item::all(); どちらが適正か*/


        /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
            $items = Item::where('name', 'LIKE', "%{$keyword}%")
            ->paginate(5);

        }else{
            $items = Item::paginate(5);
        }

        return view('item.index', compact('items'));

    }
}
