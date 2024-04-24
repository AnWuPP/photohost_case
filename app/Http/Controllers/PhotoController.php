<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required|array|max:5',
        ]);
        $files = $request->file('files');
        foreach ($files as $file) {
            /**
             * @var Illuminate\Support\Stringable $fileName
             * @var Illuminate\Http\UploadedFile $file
             */
            if (! $file->isValid()) {
                return redirect()->back()->withErrors([
                    'files' => 'The file is invalid.',
                ]);
            }
            $fileName = Str::of($file->getClientOriginalName())
                ->snake()
                ->lower()
                ->remove('.' . $file->extension())
                ->transliterate('@');
            if (Storage::disk('public')->exists('photos/'. $fileName . '.' . $file->extension())) {
                $fileName = $fileName . '_' . time();
            }
            $file->storeAs('public/photos', $fileName . '.' . $file->extension());
            $newFile = Photo::create([
                'name' => $fileName . '.' . $file->extension(),
            ]);
            $newFile->save();
        }
        return redirect()->route('welcome');
    }
}
