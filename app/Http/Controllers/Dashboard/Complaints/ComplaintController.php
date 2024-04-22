<?php

namespace App\Http\Controllers\Dashboard\Complaints;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
        //
        $complaints = Complaint::orderByDesc('id')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhereHas('product', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(15)
            ->withQueryString();

        return view('pages.complaints.index', compact('complaints'));
    }

    public function destroy(Complaint $complaint)
    {
        //
        $complaint->delete();
        //
        return redirect()->route('complaints.index');
    }
}
