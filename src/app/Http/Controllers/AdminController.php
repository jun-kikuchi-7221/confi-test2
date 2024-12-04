<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $query = Contact::query();

        // 検索条件（略）
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
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
