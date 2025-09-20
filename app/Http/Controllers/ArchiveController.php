<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $archives = Archive::with('category')
            ->when($q, fn($query)=>$query->where('title','like',"%{$q}%"))
            ->orderByDesc('archived_at')->orderByDesc('id')
            ->paginate(10)->withQueryString();

        return view('archives.index', compact('archives','q'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->pluck('name','id');
        return view('archives.form', ['archive'=>new Archive(),'categories'=>$categories,'mode'=>'create']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number'      => ['required','string','max:100'],
            'category_id' => ['required','exists:categories,id'],
            'title'       => ['required','string','max:255'],
            'file'        => ['required','file','mimetypes:application/pdf','max:5120'], // 5MB
        ],[
            'file.mimetypes'=>'File yang diupload harus berupa PDF.'
        ]);

        $path = $request->file('file')->store('archives','public');

        $archive = Archive::create([
            'number' => $data['number'],
            'category_id' => $data['category_id'],
            'title'  => $data['title'],
            'file_path' => $path,
            'archived_at' => now(),
        ]);

        return redirect()->route('archives.index')
            ->with('success','Data berhasil disimpan');
    }

    public function show(Archive $archive)
    {
        $archive->load('category');
        return view('archives.show', compact('archive'));
    }

    public function edit(Archive $archive)
    {
        $categories = Category::orderBy('name')->pluck('name','id');
        return view('archives.form', ['archive'=>$archive,'categories'=>$categories,'mode'=>'edit']);
    }

    public function update(Request $request, Archive $archive)
    {
        $data = $request->validate([
            'number'      => ['required','string','max:100'],
            'category_id' => ['required','exists:categories,id'],
            'title'       => ['required','string','max:255'],
            'file'        => ['nullable','file','mimetypes:application/pdf','max:5120'],
        ]);

        if ($request->hasFile('file')) {
            if ($archive->file_path) Storage::disk('public')->delete($archive->file_path);
            $archive->file_path = $request->file('file')->store('archives','public');
        }

        $archive->fill([
            'number'=>$data['number'],
            'category_id'=>$data['category_id'],
            'title'=>$data['title'],
        ])->save();

        return redirect()->route('archives.index')->with('success','Data berhasil disimpan');
    }

    public function destroy(Archive $archive)
    {
        if ($archive->file_path) Storage::disk('public')->delete($archive->file_path);
        $archive->delete();
        return back()->with('success','Data berhasil dihapus');
    }

    public function download(Archive $archive)
    {
        return Storage::disk('public')->download($archive->file_path, str($archive->title)->slug('_').'.pdf');
    }
}
