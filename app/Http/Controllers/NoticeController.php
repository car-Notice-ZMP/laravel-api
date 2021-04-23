<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{

    public function index()
    {
        $notices = Notice::all();

        return response()->json(['All notices' => $notices], 200, [],JSON_UNESCAPED_SLASHES);
    }

    public function show($id, Notice $notice)
    {
        $notice_with_comment = $notice->showNotice($id);

        return response()->json(['notice_with_comment' => $notice_with_comment], 200, [],JSON_UNESCAPED_SLASHES);
    }

    public function showMyNotices()
    {
        $user      = auth()->user();
        $my_notice = $user->notices()->get();

        return response()->json(['my_all_notices' => $my_notice], 200, [],JSON_UNESCAPED_SLASHES);
    }

    public function store(NoticeRequest $request, Notice $notice)
    {
        $user   = auth()->user();
        $upload = $notice->image  = $request->file('image');

        $notice->storeNotice($user, $request->all(), $upload);

        return response()->json(['message' => 'Udało się dodać ogłoszenie']);
    }

    public function destroy($id, Notice $notice)
    {
        $user = auth()->user();

        $notice->destroyNotice($id, $user);

        return response()->json(['message' => 'Udało się usunąć ogłoszenie']);
    }

    public function update($id, Request $request, Notice $notice)
    {

        $user = auth()->user();
        $upload = $notice->image  = $request->file('image');

        $notice->updateNotice($id, $request->all(), $user, $upload);

        return response()->json(['message' => 'Udało się zaktualizować ogłoszenie']);
    }

    public function freshStatus ($id, Notice $notice)
    {

        $user = auth()->user();

        $notice->freshNoticeStatus($id, $user);

        return response()->json(['message' => 'Status ogłoszenia został zmieniony']);

    }
}
