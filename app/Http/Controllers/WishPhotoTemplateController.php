<?php

namespace App\Http\Controllers;

use App\Models\WishPhotoTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class WishPhotoTemplateController extends Controller
{
    /**
     * Display a listing of the templates.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = WishPhotoTemplate::query();

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Search by name if provided
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $templates = $query->latest()->paginate(15);

        return view('wish_photo_templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new template.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wish_photo_templates.create');
    }

    /**
     * Store a newly created template in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required|max:50',
            'image' => 'required|image|max:2048', // 2MB Max
            'editable_areas' => 'required|json',
        ]);

        $imagePath = $request->file('image')->store('wish_photo_templates', 'public');

        // Optionally resize the image
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 800);
        $image->save();

        $template = WishPhotoTemplate::create([
            'name' => $validatedData['name'],
            'category' => $validatedData['category'],
            'image_path' => $imagePath,
            'editable_areas' => $validatedData['editable_areas'],
        ]);

        return redirect()->route('wish-photo-templates.index')
            ->with('success', 'Template created successfully.');
    }

    /**
     * Display the specified template.
     *
     * @param  \App\Models\WishPhotoTemplate  $wishPhotoTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(WishPhotoTemplate $wishPhotoTemplate)
    {
        return view('wish_photo_templates.show', compact('wishPhotoTemplate'));
    }

    /**
     * Show the form for editing the specified template.
     *
     * @param  \App\Models\WishPhotoTemplate  $wishPhotoTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(WishPhotoTemplate $wishPhotoTemplate)
    {
        return view('wish_photo_templates.edit', compact('wishPhotoTemplate'));
    }

    /**
     * Update the specified template in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WishPhotoTemplate  $wishPhotoTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WishPhotoTemplate $wishPhotoTemplate)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required|max:50',
            'image' => 'sometimes|image|max:2048', // 2MB Max
            'editable_areas' => 'required|json',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($wishPhotoTemplate->image_path);

            // Store new image
            $imagePath = $request->file('image')->store('wish_photo_templates', 'public');

            // Optionally resize the image
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 800);
            $image->save();

            $wishPhotoTemplate->image_path = $imagePath;
        }

        $wishPhotoTemplate->update([
            'name' => $validatedData['name'],
            'category' => $validatedData['category'],
            'editable_areas' => $validatedData['editable_areas'],
        ]);

        return redirect()->route('wish-photo-templates.index')
            ->with('success', 'Template updated successfully.');
    }

    /**
     * Remove the specified template from storage.
     *
     * @param  \App\Models\WishPhotoTemplate  $wishPhotoTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(WishPhotoTemplate $wishPhotoTemplate)
    {
        // Delete the image file
        Storage::disk('public')->delete($wishPhotoTemplate->image_path);

        // Delete the template
        $wishPhotoTemplate->delete();

        return redirect()->route('wish-photo-templates.index')
            ->with('success', 'Template deleted successfully.');
    }

    /**
     * Get a list of templates for API use.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiIndex(Request $request)
    {
        $query = WishPhotoTemplate::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $templates = $query->get()->map(function ($template) {
            return [
                'id' => $template->id,
                'name' => $template->name,
                'category' => $template->category,
                'image_url' => asset('storage/' . $template->image_path),
                'editable_areas' => $template->editable_areas,
            ];
        });

        return response()->json($templates);
    }
}