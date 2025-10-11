<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class UsersIndexController extends Controller
{
   public function __invoke()
{
    $users = User::query()
        ->latest()
        ->select('id','name','email','created_at')
        ->paginate(10)         // 👈 pagination serveur
        ->withQueryString();

    return Inertia::render('users/Index', ['users' => $users]);
}

}
