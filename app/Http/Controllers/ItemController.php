<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Group;
use App\Item;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $groups = Group::where("user_id", Auth::id())->get();
        $itemsSets = [];
        foreach ($groups as $group) {
            $items = Item::where("group_id", $group['id'])->get();
            $itemsSets[$group['id']] = $items;
        }
        return view('home', ['items' => $itemsSets], ['groups' => $groups]);
    }

    public function store()
    {
        // $group = new Group();
        // $group->user_id = request('user_id');
        // $group->save();

        $item = new Item();
        $item->description = request('description');
        $item->group_id = request('group_id');
        $item->save();

        return redirect('/');
    }

    public function update($id)
    {
        $item = Item::find($id);
        $item->checked = request('checked');
        $item->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect('/');
    }
}
