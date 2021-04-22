<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchNoticeRequest;
use App\Models\Notice;
use Illuminate\Http\Request;

class SearchController extends Controller

{
    public function search (Notice $notice, SearchNoticeRequest $request)
    {
        $searchResults = $notice->performSearch($request);

        return response()->json(['Result' => $searchResults], 200, [],JSON_UNESCAPED_SLASHES);
    }

    public function searchBetween (Notice $notice, Request $request)
    {
        $searchResults = $notice->performSearchInRange($request);

        return response()->json(['Result' => $searchResults], 200, [],JSON_UNESCAPED_SLASHES);
    }

}

