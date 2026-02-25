<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CvTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CvTemplateController extends Controller
{
    /**
     * Menampilkan daftar template.
     */
    public function index(Request $request)
    {
        $templates = CvTemplate::latest()->get(); 
        return view('admin.templates.index', compact('templates'));
    }

    /**
     * Menampilkan halaman buat template baru.
     */
    public function create()
    {
        return view('admin.templates.create');
    }

    /**
     * Menyimpan template ke database.
     */
    public function store(Request $request)
    {
        // 1. Pesan Validasi Custom
        $messages = [
            'name.required'         => 'Nama template wajib diisi.',
            'thumbnail.required'    => 'Gambar preview wajib diupload.',
            'thumbnail.image'       => 'File harus berupa gambar (jpg, jpeg, png, webp).',
            'thumbnail.max'         => 'Ukuran gambar maksimal 2MB.',
            'category.required'     => 'Kategori wajib dipilih.',
            'type.required'         => 'Tipe akses (Free/Pro) wajib dipilih.',
            'price.numeric'         => 'Harga harus berupa angka.',
            'form_schema.required'  => 'Struktur Form (Builder) tidak boleh kosong.',
            'form_schema.json'      => 'Terjadi kesalahan pada format data Form Builder.',
        ];

        // 2. Validasi Input
        $request->validate([
            'name'        => 'required|string|max:255',
            'thumbnail'   => 'required|image|max:2048|mimes:jpg,jpeg,png,webp', 
            'category'    => 'required|string',
            'type'        => 'required|in:free,pro',
            'price'       => 'nullable|numeric|min:0',
            'form_schema' => 'required|json', 
        ], $messages);

        // 3. Generate Unique Slug (SOLUSI ERROR DUPLICATE ENTRY)
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        
        // Cek database, jika slug ada, tambah angka (modern -> modern-1)
        while (CvTemplate::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // 4. Upload Gambar
        $path = $request->file('thumbnail')->store('templates', 'public');

        // 5. Proses Data Lain
        $tagsArray = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];
        $schemaArray = json_decode($request->form_schema, true);

        // 6. Simpan Data
        CvTemplate::create([
            'name'            => $request->name,
            'slug'            => $slug, // Menggunakan slug yang sudah divalidasi unik
            'description'     => $request->description,
            'thumbnail'       => $path,
            'category'        => $request->category,
            'type'            => $request->type,
            'price'           => $request->price ?? 0,
            'tags'            => $tagsArray, 
            'form_schema'     => $schemaArray, 
            'is_active'       => $request->has('is_active'),
            'is_new'          => $request->has('is_new'),
            'total_downloads' => 0,
            'rating'          => 0
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil dibuat dan diterbitkan!');
    }

    /**
     * Menampilkan halaman edit template.
     */
    public function edit($id)
    {
        $template = CvTemplate::findOrFail($id);
        return view('admin.templates.edit', compact('template'));
    }

    /**
     * Memperbarui data template.
     */
    public function update(Request $request, $id)
    {
        $template = CvTemplate::findOrFail($id);
        
        // 1. Validasi
        $request->validate([
            'name'        => 'required|string|max:255',
            'thumbnail'   => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
            'category'    => 'required|string',
            'type'        => 'required|in:free,pro',
            'price'       => 'nullable|numeric|min:0',
            'form_schema' => 'nullable|json',
        ]);

        // 2. Siapkan Data Dasar
        $dataToUpdate = [
            'name'        => $request->name,
            'description' => $request->description,
            'category'    => $request->category,
            'type'        => $request->type,
            'price'       => $request->price ?? 0,
            'is_active'   => $request->has('is_active'),
            'is_new'      => $request->has('is_new'),
        ];

        // 3. Cek Perubahan Nama untuk Slug
        if ($request->name !== $template->name) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;

            // Cek duplikat KECUALI id diri sendiri
            while (CvTemplate::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $dataToUpdate['slug'] = $slug;
        }

        // 4. Update Gambar (Hapus lama jika ada baru)
        if ($request->hasFile('thumbnail')) {
            if ($template->thumbnail) {
                Storage::disk('public')->delete($template->thumbnail);
            }
            $dataToUpdate['thumbnail'] = $request->file('thumbnail')->store('templates', 'public');
        }

        // 5. Update Tags
        if ($request->has('tags')) {
            $dataToUpdate['tags'] = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];
        }

        // 6. Update Schema (Builder)
        if ($request->filled('form_schema')) {
            $dataToUpdate['form_schema'] = json_decode($request->form_schema, true);
        }

        // 7. Eksekusi Update
        $template->update($dataToUpdate);

        return redirect()->route('admin.templates.index')->with('success', 'Template berhasil diperbarui!');
    }

    /**
     * Menghapus template.
     */
    public function destroy($id)
    {
        $template = CvTemplate::findOrFail($id);
        
        if ($template->thumbnail) {
            Storage::disk('public')->delete($template->thumbnail);
        }
        
        $template->delete();

        return redirect()->back()->with('success', 'Template berhasil dihapus!');
    }
}