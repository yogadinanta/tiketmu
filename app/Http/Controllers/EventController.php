<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show($id, $slug)
    {
        $event = Event::with('vendor')->findOrFail($id);
        return view('home/event-detail', compact('event'));
    }

    // DESTROY FUNCION
  public function destroy(Event $event)
{
    // Hapus gambar dari storage jika ada
    if($event->image){
        \Storage::disk('public')->delete($event->image);
    }

    // Hapus event dari database
    $event->delete();

    return redirect()->back()->with('success', 'Event berhasil dihapus.');
}


}
