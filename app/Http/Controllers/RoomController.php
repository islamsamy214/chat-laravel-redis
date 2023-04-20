<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Message;
use App\Models\Room;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\SendMessage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if ($request->has('user_id')) {
            // dd('this query is working but its not properly working in ORM', "SELECT * FROM rooms WHERE users_ids->'$.user_id_12' = 12 AND users_ids->'$.user_id_1' = 1");
            $room = Room::whereRaw("users_ids->'$.user_id_" . auth()->user()->id . "' = " . auth()->user()->id . " AND users_ids->'$.user_id_" . $request->user_id . "' = " . $request->user_id . "")->first();
            if ($room) {
                $messages = Message::where('room_id', $room->id)->latest()->paginate(20);
                $room_id = $room->id;
            }
            // if not, create a new room
            else {
                $room = Room::create([
                    'users_ids' => json_encode(['user_id_' . auth()->user()->id => auth()->user()->id, 'user_id_' . intval($request->user_id) => intval($request->user_id)])
                ]);
                $messages = Message::where('room_id', $room->id)->latest()->paginate(20);
                $room_id = $room->id;
            }
        } elseif ($request->has('room_id')) {
            $messages = Message::where('room_id', $request->room_id)->latest()->paginate(20);
            $room_id = $request->room_id;
        } else {
            $messages = Message::paginate(20);
        }
        $response_data = [
            'users' => User::all()->except(auth()->user()->id),
            'messages' => $messages ?? [],
        ];

        isset($room_id) ? $response_data['room_id'] = $room_id : $response_data['user_id'] = $request->user_id;

        return view('room', $response_data);
    } // end of index

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $message = Message::create([
            'message' => $request->message,
            'room_id' => $request->room_id,
            'user_id' => auth()->user()->id,
        ]);

        event(new SendMessage(['message' => $message, 'user_name' => auth()->user()->name]));

        return response()->json($message, 200);
    } // end of store
}
