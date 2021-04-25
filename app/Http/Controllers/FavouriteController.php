<?php

namespace App\Http\Controllers;

use App\Models\Notice;

class FavouriteController extends Controller
{
    public function store($id)
    {
        $user   = auth()->user();
        $notice = Notice::find($id);

        $user->favorite($notice);

        return response()->json(['message' => 'Dodano do ulubionych'], 200, [],JSON_UNESCAPED_SLASHES);
    }

    public function show()
    {
        $user   = auth()->user();
        $notice = $user->getFavoriteItems(Notice::class)->with('statuses');

        return response()->json(['favourites' => $notice->get()], 200, [],JSON_UNESCAPED_SLASHES);
    }

    public function unfavourite($id)
    {
        $user   = auth()->user();
        $notice = Notice::find($id);

        $user->unfavorite($notice);

        return response()->json(['message' => 'Usunięto z ulubionych']);
    }

    public function count()
    {
        $user   = auth()->user();
        $total = $user->favorites()->count();

        return response()->json(['Ilość polubień' => $total]);
    }
}
