<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Models\Story;
use App\Models\Wedding;

class StoryController extends Controller
{
    public function index()
    {
        $wedding = Wedding::firstOrFail();
        $stories = $wedding->stories;
        return view('admin.stories', compact('stories', 'wedding'));
    }

    public function store(StoryRequest $request)
    {
        $wedding = Wedding::firstOrFail();
        $maxOrder = $wedding->stories()->max('sort_order') ?? 0;

        $story = $wedding->stories()->create([
            ...$request->validated(),
            'sort_order' => $maxOrder + 1,
        ]);

        return response()->json(['success' => true, 'message' => 'Story berhasil ditambahkan.', 'data' => $story]);
    }

    public function update(StoryRequest $request, Story $story)
    {
        $story->update($request->validated());
        return response()->json(['success' => true, 'message' => 'Story berhasil diperbarui.', 'data' => $story]);
    }

    public function destroy(Story $story)
    {
        $story->delete();
        return response()->json(['success' => true, 'message' => 'Story berhasil dihapus.']);
    }
}
