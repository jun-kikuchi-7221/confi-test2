<?php

namespace App\Http\Controllers;

use App\Models\Contact; // データ取得用のモデル
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        // 検索条件に基づいてデータを取得
        $query = Contact::query();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%');
        }

        // 必要に応じて追加の絞り込み条件

        $contacts = $query->get();

        // CSVをストリームとして返却
        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOMを追加
            echo "\xEF\xBB\xBF";


            // ヘッダー行
            fputcsv($handle, ['ID', 'カテゴリID', '名前', 'メール', '電話番号', '住所']);

            // データ行
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->category_id,
                    $contact->first_name . ' ' . $contact->last_name,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                ]);
            }

            fclose($handle);
        });

        // レスポンスのヘッダー設定
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="contacts.csv"');

        return $response;
    }
}
