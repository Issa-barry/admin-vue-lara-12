<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class UsersIndexController extends Controller
{
   public function __invoke(\Illuminate\Http\Request $r)
{
     $q     = $r->string('q');
    $rows  = (int) $r->input('rows', 10);
    $sort  = $r->string('sort', 'id');
    $order = $r->string('order', 'desc');

    $users = \App\Models\User::query()
        ->when($q, fn($qq) =>
            $qq->where(fn($w) =>
                $w->where('name', 'like', "%$q%")
                  ->orWhere('email', 'like', "%$q%")
            )
        )
        ->orderBy($sort, $order)
        ->select('id','name','email','created_at')
        ->paginate($rows)
        ->withQueryString();

    return \Inertia\Inertia::render('users/Index', compact('users','q','rows','sort','order'));
}

}
