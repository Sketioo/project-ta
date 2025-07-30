<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\CurriculumImage;
use Illuminate\Support\Facades\Storage;

class CurriculumImageController extends Controller
{
    public function destroy(CurriculumImage $curriculumImage)
    {
        // Delete the image file from storage
        Storage::delete($curriculumImage->image_path);

        // Delete the record from the database
        $curriculumImage->delete();

        return response()->json(['success' => true]);
    }
}
