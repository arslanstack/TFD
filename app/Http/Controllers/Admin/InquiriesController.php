<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Validator;

class InquiriesController extends Controller
{
    public function index(Request $request)
    {
        // $query = Inquiry::query();
        // $search_query = $request->input('search_query');
        // if ($request->has('search_query') && !empty($search_query)) {
        //     $query->where(function ($query) use ($search_query) {
        //         $query->where('name', 'like', '%' . $search_query . '%')
        //         ->orWhere('email', 'like', '%' . $search_query . '%')
        //         ->orWhere('phone', 'like', '%' . $search_query . '%')
        //         ->orWhere('created_at', 'like', '%' . $search_query . '%');
        //     });
        // }
        // $data['inquiries'] = $query->orderBy('id', 'DESC')->paginate(50);
        // $data['searchParams'] = $request->all();
        // return view('admin/dashboard', $data);


        $query = Inquiry::query();
        $search_date = $request->input('search_date');
        if ($request->has('search_date') && !empty($search_date)) {
            $query->where(function ($query) use ($search_date) {
                $query->where('name', 'like', '%' . $search_date . '%')
                ->orWhere('email', 'like', '%' . $search_date . '%')
                ->orWhere('phone', 'like', '%' . $search_date . '%')
                ->orWhere('created_at', 'like', '%' . $search_date . '%');
            });
        }
        $data['inquiries'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/dashboard', $data);
    }

    public function details($id)
    {
        $inquiry = Inquiry::find($id);
        if (!$inquiry) {
            return redirect()->back()->with('error', 'Inquiry not found.');
        }
        return view('admin/inquiries/inquiry_details', compact('inquiry'));
    }

    public function destroy(Request $request)
    {
        $inquiry = Inquiry::find($request->id);
        if ($inquiry) {
            $inquiry->delete();
            return response()->json(['msg' => 'success', 'response' => 'Inquiry deleted successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Inquiry not found.']);
        }
    }
}
