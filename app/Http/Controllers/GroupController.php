<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Group;
use App\Item;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store()
    {
        $group = new Group();
        $group->name = request('name');
        $group->user_id = request('user_id');
        $group->color = request('color');
        $group->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();

        return redirect('/');
    }
}
