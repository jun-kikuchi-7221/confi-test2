<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    // public function search(Request $request)
    public function index(Request $request)
    {
        $contacts = Contact::paginate(7);

        // 全てのカテゴリーを取得
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories', 'request'));
    }

    public function search(Request $request)
    {
        // 検索条件を取得
        $keyword = $request->input('keyword');
        $gender = $request->input('gender');
        $categoryId = $request->input('category_id');
        $saveDate = $request->input('save_date');

        $query = Contact::query();


        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', "%{$keyword}%")
                ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'LIKE', "%{$keyword}%") // スペースあり(姓と名で入力ボックスがが分かれているので全角にしろ半角にしろスペースがあることはあり得ないが一応設定しておく)
                ->orWhere(DB::raw("CONCAT(last_name, first_name)"), 'LIKE', "%{$keyword}%") // スペースなし
                ->orWhere('email', 'LIKE', "%{$keyword}%");
            });
        }

        if ($request->input('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 保存日検索 (created_at のみ)
        if ($request->filled('save_date')) {
            $query->whereDate('created_at', $request->save_date);
        }

        // ページネーション
        // $contacts = $query->with('category')->paginate(7);
        $contacts = $query->paginate(7);

        // 全てのカテゴリーを取得
        $categories = Category::all();

        // ビューにデータを渡す
        return view('admin', compact('contacts', 'categories', 'request'));

    }
}
