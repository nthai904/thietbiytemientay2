<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = Provider::all();
        return view('pages.provider.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.provider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Provider::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'represent' => $request->represent,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'note' => $request->note,
            'status' => $request->status,
        ]);
        return redirect()->route('provider.index')->with('success', 'Thêm mới nhà cung cấp thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provider = Provider::where('id', $id)->first();
        return view('pages.provider.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $provider = Provider::find($id);
        if ($provider) {
            $provider->update([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'represent' => $request->represent,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'note' => $request->note,
                'status' => $request->status,
            ]);
            return redirect()->route('provider.index')->with('success', 'Cập nhật nhà cung cấp thành công');
        } else {
            return redirect()->route('provider.index')->with('error', 'Không tìm thấy nhà cung cấp');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provider = Provider::find($id);
        if ($provider) {
            $provider->delete();
            return redirect()->route('provider.index')->with('success', 'Xóa nhà cung cấp thành công');
        } else {
            return redirect()->route('provider.index')->with('error', 'Không tìm thấy nhà cung cấp');
        }
    }

    
}
