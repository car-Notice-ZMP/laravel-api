<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use App\Models\User;

class NoticeController extends Controller
{
    //

    public function show($id, Notice $notice)
    {

        $notice_with_comment = $notice->showNotice($id);

        return response()->json(['notice_with_comment' => $notice_with_comment]);
    }

    public function showMyNotices()
    {
        $user   = auth()->user();
        $my_notice = $user->notices()->get();

        return response()->json(['my_all_notices' => $my_notice]);
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

    public function update($id, NoticeRequest $request, Notice $notice)
    {
        $user = auth()->user();

        $notice->updateNotice($id, $request->all(), $user);

        return response()->json(['message' => 'Udało się zaktualizować ogłoszenie']);
    }
}
