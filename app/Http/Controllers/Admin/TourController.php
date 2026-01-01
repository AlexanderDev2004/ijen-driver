<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreTourRequest;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::latest()->get();
        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        return view('admin.tours.create');
    }

    public function store(StoreTourRequest $request)
    {
        try {
            $validated = $request->validated();

            // ✅ Generate slug unik
            $slug = Str::slug($validated['title']);
            $baseSlug = $slug;
            $count = 1;
            while (Tour::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;

            // ✅ Upload image dengan security - GUNAKAN METHOD handleImageUpload()
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $this->handleImageUpload($image, $request);
                $validated['image'] = $imagePath;
            } else {
                Log::info('No image file uploaded');
                $validated['image'] = null;
            }

            // ✅ Default aktif
            $validated['is_active'] = $request->boolean('is_active', false);

            // ✅ Simpan ke database
            Tour::create($validated);

            return redirect()->route('admin.tours.index')
                ->with('success', 'Tour berhasil ditambahkan!');

        } catch (Exception $e) {
            Log::error('Error creating tour: ' . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Gagal menyimpan Tour: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit(Tour $tour)
    {
        return view('admin.tours.edit', compact('tour'));
    }

    public function update(StoreTourRequest $request, Tour $tour)
    {
        try {
            $validated = $request->validated();

            // ✅ Slug unik
            $slug = Str::slug($validated['title']);
            $baseSlug = $slug;
            $count = 1;
            while (Tour::where('slug', $slug)->where('id', '!=', $tour->id)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
            $validated['is_active'] = $request->boolean('is_active', false);

            // ✅ Ganti image jika diupload
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($tour->image && Storage::disk('public')->exists($tour->image)) {
                    Storage::disk('public')->delete($tour->image);
                }

                // Upload gambar baru dengan security
                $image = $request->file('image');
                $imagePath = $this->handleImageUpload($image, $request);
                $validated['image'] = $imagePath;
            } else {
                // Jika tidak ada gambar baru, pertahankan gambar lama
                $validated['image'] = $tour->image;
            }

            $tour->update($validated);

            return redirect()->route('admin.tours.index')
                ->with('success', 'Tour berhasil diperbarui!');

        } catch (Exception $e) {
            Log::error('Error updating tour: ' . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Gagal memperbarui Tour: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Tour $tour)
    {
        try {
            // Hapus gambar jika ada
            if ($tour->image && Storage::disk('public')->exists($tour->image)) {
                Storage::disk('public')->delete($tour->image);
            }

            $tour->delete();

            return redirect()->route('admin.tours.index')
                ->with('success', 'Tour berhasil dihapus!');

        } catch (Exception $e) {
            Log::error('Error deleting tour: ' . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Gagal menghapus Tour: ' . $e->getMessage()]);
        }
    }

    /**
     * Handle secure image upload with validation
     */
    private function handleImageUpload($image, Request $request)
    {
        $imagePath = null; // Inisialisasi variabel

        try {
            Log::info('Image file detected', [
                'file_name' => $image->getClientOriginalName(),
                'file_size' => $image->getSize(),
                'file_type' => $image->getMimeType(),
                'client_extension' => $image->getClientOriginalExtension()
            ]);

            // 1. Validasi MIME Type yang diizinkan
            $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png'];
            $actualMime = $image->getMimeType();
            if (!in_array($actualMime, $allowedMimes)) {
                throw new Exception('Jenis file tidak diizinkan. Hanya JPG, JPEG, PNG yang diperbolehkan. Detected: ' . $actualMime);
            }

            // 2. Validasi ekstensi file
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $extension = strtolower($image->getClientOriginalExtension());
            if (!in_array($extension, $allowedExtensions)) {
                throw new Exception('Ekstensi file tidak valid. Hanya jpg, jpeg, png yang diizinkan.');
            }

            // 3. Validasi ukuran file (max 2MB)
            $maxSize = 2 * 1024 * 1024; // 2MB in bytes
            $fileSize = $image->getSize();
            if ($fileSize > $maxSize) {
                throw new Exception('Ukuran file terlalu besar. Maksimal 2MB. Ukuran file: ' . round($fileSize / 1024 / 1024, 2) . 'MB');
            }

            // 4. Validasi ukuran file minimal (cegah file kosong/rusak)
            if ($fileSize < 100) {
                throw new Exception('File gambar tidak valid atau rusak. Ukuran file terlalu kecil.');
            }

            // 5. Validasi dimensi gambar
            $imageInfo = @getimagesize($image->getPathname());
            if (!$imageInfo) {
                throw new Exception('File bukan gambar yang valid.');
            }

            list($width, $height) = $imageInfo;

            // Validasi dimensi maksimal
            if ($width > 5000 || $height > 5000) {
                throw new Exception('Dimensi gambar terlalu besar. Maksimal 5000x5000 pixel. Detected: ' . $width . 'x' . $height);
            }

            // Validasi dimensi minimal
            if ($width < 100 || $height < 100) {
                throw new Exception('Dimensi gambar terlalu kecil. Minimal 100x100 pixel. Detected: ' . $width . 'x' . $height);
            }

            // 6. Cek nama file untuk mencegah path traversal
            $originalName = $image->getClientOriginalName();
            if (preg_match('/\.\.|\/|\\\\/', $originalName)) {
                throw new Exception('Nama file mengandung karakter yang tidak diizinkan.');
            }

            // 7. Scan untuk konten berbahaya
            $this->scanForMaliciousContent($image->getPathname());

            // 8. Generate nama file aman
            $safeName = 'tour-' . time() . '-' . Str::random(16) . '.' . $extension;

            // 9. Upload ke storage
            $imagePath = $image->storeAs('tours', $safeName, 'public');

            // 10. Verifikasi file berhasil diupload
            if (!Storage::disk('public')->exists($imagePath)) {
                throw new Exception('Gagal menyimpan file gambar.');
            }

            Log::info('Image uploaded successfully', [
                'path' => $imagePath,
                'safe_name' => $safeName,
                'dimensions' => $width . 'x' . $height
            ]);

            return $imagePath;

        } catch (Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage(), [
                'file_name' => $image->getClientOriginalName(),
                'ip' => $request->ip()
            ]);

            // Hapus file jika sempat terupload tapi gagal validasi
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            throw $e; // Re-throw exception untuk ditangani oleh method utama
        }
    }

    /**
     * Scan file untuk konten berbahaya
     */
    private function scanForMaliciousContent($filePath)
    {
        // Baca sebagian konten file (1024 bytes pertama cukup untuk deteksi)
        $handle = fopen($filePath, 'r');
        $firstBytes = fread($handle, 1024);
        fclose($handle);

        // Deteksi PHP code dalam gambar
        if (preg_match('/<\?php|eval\(|base64_decode|gzinflate/i', $firstBytes)) {
            throw new Exception('File gambar mengandung konten yang mencurigakan (PHP code detected).');
        }

        // Deteksi script tags
        if (preg_match('/<script|javascript:/i', $firstBytes)) {
            throw new Exception('File gambar mengandung konten yang mencurigakan (Script detected).');
        }

        // Deteksi file signatures berbahaya
        $signatures = [
            '4D5A' => 'EXE', // Windows executable
            '7F454C46' => 'ELF', // Linux executable
            '2321' => 'Shell script', // Shebang
            '25504446' => 'PDF', // PDF (bisa berisi malicious code)
        ];

        $firstBytesHex = bin2hex(substr($firstBytes, 0, 4));

        foreach ($signatures as $signature => $type) {
            if (strpos($firstBytesHex, $signature) === 0) {
                throw new Exception("File terdeteksi sebagai {$type}, bukan gambar.");
            }
        }

        // Deteksi file kosong atau corrupted
        if (strlen($firstBytes) < 10) {
            throw new Exception('File gambar rusak atau tidak valid.');
        }
    }
}
