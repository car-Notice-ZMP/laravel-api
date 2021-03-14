<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;


class NoticeController extends Controller
{
    //
    public function store (NoticeRequest $request, Notice $notice)
    {
        $user = auth()->user();
        $notice->storeNotice($user, $request->all());

        return response()->json( [ 'message' => 'Udało się dodać ogłoszenie'] );

    }

    public function destroy ($id, Notice $notice)
    {
        $notice->destroyNotice($id);

        return response()->json(['message' => 'Udało się usunąć ogłoszenie']);
    }

    public function update ($id, NoticeRequest $request, Notice $notice)
    {
        $notice->updateNotice($id, $request->all());

        return response()->json(['message' => 'Udało się zaktualizować ogłoszenie']);
    }
}
