<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use illuminate\Support\Str;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MediaController extends Controller
{

    public function index()
    {
        $media = Media::paginate(12);
        return Inertia::render(
            'Admin/Media/Index',
            [
                'medias' => $media,
                'title' => 'Media Page'
            ]
        );
    }
    public function storeImage(Request $request)
    {
        $mediaIds = [];
        if ($request->hasFile('media')) {
            $images = $request->file('media');
            $images = is_array($images) ? $images : [$images];

            foreach ($images as $image) {
                $originalFilename = $image->getClientOriginalName();
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/media', $filename);

                $url = Storage::url($path);

                $media = Media::create([
                    'filename' => $filename,
                    'original_filename' => $originalFilename,
                    'mime_type' => $image->getMimeType() || 'image/jpeg',
                    'path' => $path,
                    'url' => $url,
                    'size' => $image->getSize(),
                ]);

                $mediaIds[] = [
                    'id' => $media->id,
                    'url' => $url
                ];
            }
            return Session::flash('responseData', $mediaIds);
        } else {
            return response()->json(['error' => 'No files uploaded'], 400);
        }
    }
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        if (Storage::exists($media->path)) {
            Storage::delete($media->path);
        }
        $media->delete();
        return redirect()->back()->with('success', 'Media deleted successfully');
    }
}
