<?php

namespace App\Http\Controllers;

use App\Models\UserWishPhoto;
use App\Models\WishPhotoTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserWishPhotoController extends Controller
{
    public function index()
    {
        $userWishPhotos = auth()->user()->userWishPhotos()->latest()->get();
        return view('user_wish_photos.index', compact('userWishPhotos'));
    }

    public function show($id)
    {
        // Find the UserWishPhoto by ID or fail
        $userWishPhoto = UserWishPhoto::findOrFail($id);

        // Return the view and pass the UserWishPhoto object
        return view('user_wish_photos.show', compact('userWishPhoto'));
    }

    public function download($id)
    {
        $userWishPhoto = UserWishPhoto::findOrFail($id);
    
        $filePath = storage_path('app/public/' . $userWishPhoto->final_image_path);
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
    
        return redirect()->route('user-wish-photos.index')->with('error', 'File not found.');
    }
    
    public function create(Request $request, $templateId = null)
    {
        if ($templateId) {
            $template = WishPhotoTemplate::findOrFail($templateId);
        } else {
            $template = WishPhotoTemplate::first();
        }
    
        if (!$template) {
            abort(404, 'No template found');
        }
    
        $template->editable_areas = $template->editable_areas ?: [];
        
        return view('user_wish_photos.create', compact('template'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'wish_photo_template_id' => 'required|exists:wish_photo_templates,id',
                'customization_data' => 'required|json',
                'canvas_width' => 'required|integer',
                'canvas_height' => 'required|integer',
                'background_width' => 'required|integer',
                'background_height' => 'required|integer',
            ]);
    
            Log::info('Validation passed', $request->all());
    
            $template = WishPhotoTemplate::findOrFail($request->wish_photo_template_id);
            $customizationData = json_decode($request->customization_data, true);
    
            // Create ImageManager instance with GD driver
            $manager = new ImageManager(new Driver());
    
            // Create base image
            $image = $manager->read(storage_path('app/public/' . $template->image_path));
    
            // Resize image if necessary
            if ($request->background_width != $request->canvas_width || $request->background_height != $request->canvas_height) {
                $image->resize($request->canvas_width, $request->canvas_height);
            }
    
            Log::info('Base image created and resized if necessary');
    
            // Apply customizations
            foreach ($customizationData['objects'] as $object) {
                if ($object['type'] === 'i-text') {
                    $fontPath = $this->getFontPath($object['fontFamily']);
                    
                    // Draw background color with opacity if specified
                    if (isset($object['backgroundColor'])) {
                        $bgColor = $this->parseColor($object['backgroundColor']);
                        $textWidth = $object['width'];
                        $textHeight = $object['height'];
    
                        // Use drawRectangle method to create a background rectangle
                        $image->drawRectangle(
                            $object['left'],
                            $object['top'],
                            function ($rectangle) use ($bgColor, $textWidth, $textHeight) {
                                $rectangle->width($textWidth);
                                $rectangle->height($textHeight);
                                $rectangle->background($bgColor);
                            }
                        );
                    }
    
                    // Draw text with properties
                    $image->text($object['text'], $object['left'], $object['top'], function($font) use ($fontPath, $object) {
                        $font->filename($fontPath);
                        $font->size($object['fontSize']);
                        $font->color($object['fill']);
                        $font->align('left');
                        $font->valign('top');
                        
                        if (isset($object['underline']) && $object['underline']) {
                            $font->underline();
                        }
                    });
                }
            }
    
            Log::info('Customizations applied');
    
            // Save the customized image
            $imagePath = 'user_wish_photos/' . uniqid() . '.png';
            Storage::disk('public')->put($imagePath, $image->toPng());
    
            Log::info('Image saved', ['path' => $imagePath]);
    
            // Create UserWishPhoto record
            $userWishPhoto = auth()->user()->userWishPhotos()->create([
                'wish_photo_template_id' => $request->wish_photo_template_id,
                'customization_data' => $request->customization_data,
                'final_image_path' => $imagePath,
            ]);
    
            Log::info('UserWishPhoto record created', ['id' => $userWishPhoto->id]);
    
            return response()->json(['success' => true, 'message' => 'Wish photo saved successfully']);
        } catch (\Exception $e) {
            Log::error('Error in UserWishPhotoController@store', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Get the font path based on font family name.
     *
     * @param string $fontFamily
     * @return string
     */
    private function getFontPath($fontFamily)
    {
        $fontMap = [
            'Open Sans' => 'OpenSans-Regular.ttf',
            'Lobster' => 'Lobster-Regular.ttf',
            'Roboto' => 'Roboto-Regular.ttf',
        ];
    
        $fontFileName = $fontMap[$fontFamily] ?? 'OpenSans-Regular.ttf';
        return public_path("fonts/{$fontFileName}");
    }
    
    /**
     * Parse color into appropriate format.
     *
     * @param string $color
     * @return string
     */
    private function parseColor($color)
    {
        if (strpos($color, 'rgba') === 0) {
            list($r, $g, $b, $a) = sscanf($color, "rgba(%d, %d, %d, %f)");
            return "rgba($r, $g, $b, $a)";
        }
        return $color;
    }
    
}