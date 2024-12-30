<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class HashPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:hash-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '全ユーザーのパスワードをハッシュ化します';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            // 既にハッシュ化されている場合はスキップ
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
                $user->save();
                $this->info("ユーザーID {$user->id} のパスワードをハッシュ化しました。");
            } else {
                $this->info("ユーザーID {$user->id} のパスワードは既にハッシュ化されています。");
            }
        }
        $this->info('すべてのユーザーのパスワードをチェックしました。');
    }
}
