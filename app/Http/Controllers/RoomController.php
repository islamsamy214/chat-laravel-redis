<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Message;
use App\Models\Room;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\SendMessage;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if ($request->has('user_id')) {
            $his_rooms = Message::where('user_id', $request->user_id)->pluck('room_id');
            $my_rooms = Message::where('user_id', auth()->user()->id)->pluck('room_id');
            $room_id = $his_rooms->intersect($my_rooms)->first();

            if ($room_id) {
                // reverse order the collection
                $messages = Message::where('room_id', $room_id)->latest()->paginate(20);
            }
        } elseif ($request->has('room_id')) {
            $messages = Message::where('room_id', $request->room_id)->latest()->paginate(20);
            $room_id = $request->room_id;
        } else {
            $messages = Message::paginate(20);
        }
        return view('room', [
            'users' => User::all(),
            'room_id' => $room_id ?? null,
            'messages' => $messages ?? [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        dd($request->all());
        $message = Message::create([
            'message' => $request->message,
            'room_id' => $request->room_id,
            'user_id' => auth()->user()->id,
        ]);
        event(new SendMessage(['message' => $message, 'user_name' => auth()->user()->name]));

        return response()->json($message, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): View
    {
        return view('rooms.show', [
            'room' => $room,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room): View
    {
        return view('rooms.edit', [
            'room' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room): RedirectResponse
    {
        $room->update($request->validated());

        return Redirect::route('rooms.show', $room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room): RedirectResponse
    {
        $room->delete();

        return Redirect::route('rooms.index');
    }
}
