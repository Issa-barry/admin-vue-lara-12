<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class UsersCreateController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('users/Create'); // rend la page Create.vue que tu as déjà
    }
}
