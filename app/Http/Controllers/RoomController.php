<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('rooms.index', [
            'rooms' => Room::all(),
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
    public function store(StoreRoomRequest $request): RedirectResponse
    {
        $room = Room::create($request->validated());

        return Redirect::route('rooms.show', $room);
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
