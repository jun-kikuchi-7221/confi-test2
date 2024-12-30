<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::with('category')->get();
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $tel1 = $request->input('tel1');
        $tel2 = $request->input('tel2');
        $tel3 = $request->input('tel3');
        $tel = "{$tel1}{$tel2}{$tel3}";


        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        $contact['tel'] = $tel;

        // カテゴリIDを取得
        // $categoryId = $request->input('category_id');
        $category = Category::find($contact['category_id']);
        $contact['category'] = $category->content; // 'category' インデックスにカテゴリ名を設定
        // $contact['category_id'] = $categoryId;
       
        return view('confirm', compact('contact'));
    }

    public function edit(Request $request)
    {
        // 入力データをセッションに保存
        session(['form_data' => $request->all()]);

        // indexリダイレクト
        return redirect('/home')->withInput();
    }

    public function store(Request $request)
    {
        $contact = $request->only(['category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail']);

        Contact::create($contact);

        session()->forget('form_data');

        return view('thanks');
    }

    public function destroy($id)
    {
        // 指定されたIDのコンタクトを削除
        $contact = Contact::findOrFail($id);
        $contact->forceDelete();

        // 削除後に管理画面にリダイレクト
        return redirect()->route('admin')->with('success', 'お問い合わせを削除しました。');
    }
}
