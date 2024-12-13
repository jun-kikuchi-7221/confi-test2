<?php

namespace App\Http\Controllers;

use App\Models\Contact; // データ取得用のモデル
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        // 検索条件を取得
        $keyword = $request->input('keyword');
        $gender = $request->input('gender');
        $categoryId = $request->input('category_id');
        $saveDate = $request->input('save_date');

        // クエリビルダの準備
        $query = Contact::query();

        // 検索条件を適用
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', "%{$keyword}%")
                ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                ->orWhere(DB::raw("CONCAT(last_name, ' ', first_name)"), 'LIKE', "%{$keyword}%")
                ->orWhere(DB::raw("CONCAT(last_name, first_name)"), 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%");
            });
        }

        if (!empty($gender) && $gender !== 'all') {
            $query->where('gender', $gender);
        }

        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        if (!empty($saveDate)) {
            $query->whereDate('created_at', $saveDate);
        }

        $contacts = $query->get();

        // CSVをストリームとして返却
        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOMを追加
            echo "\xEF\xBB\xBF";


            // ヘッダー行
            fputcsv($handle, ['ID', '名前', '性別',  'メール', '電話番号', '住所','建物名', 'お問い合わせの種類', 'お問い合わせ内容']);

            // 性別の変換用配列
            $genderLabels = [
                1 => '男性',
                2 => '女性',
                3 => 'その他',
            ];

            // データ行
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    $genderLabels[$contact->gender] ?? '不明', // 性別を漢字に変換。該当しない場合は「不明」
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    optional($contact->category)->content,
                    $contact->detail,
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
