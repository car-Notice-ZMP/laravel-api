<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notice;

class FavouriteController extends Controller
{
    //
    public function store ($id)
    {

        $user   = auth()->user();

        $notice = Notice::find($id);

        $user->favorite($notice);

        return response()->json(['message' => 'Dodano do ulubionych']);


    }

    public function show ()
    {
        $user   = auth()->user();

        $notice = $user->getFavoriteItems(Notice::class);

        return response()->json(['favourites' => $notice->get()]);
    }

    public function unfavourite ($id)
    {
        $user   = auth()->user();

        $notice = Notice::find($id);

        $user->unfavorite($notice);

        return response()->json(['message' => 'Usunięto z ulubionych']);

    }
}
