<?php

namespace App\Http\Controllers;

use App\Models\Booking; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('buku')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('booking.index', compact('bookings'));
    }

    public function store(Request $request, $id)
    {
        $exists = Booking::where('user_id', auth()->id())
            ->where('buku_id', $id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Buku ini sudah ada di daftar bookmark kamu!');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'buku_id' => $id,
            'status'  => 'Bookmark' 
        ]);

        return redirect()->route('booking.index')->with('success', 'Buku berhasil ditambahkan ke bookmark!');
    }

    public function destroy($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
            
        $booking->delete();

        return back()->with('success', 'Bookmark berhasil dihapus.');
    }
}