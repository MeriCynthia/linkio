<?php

namespace App\Http\Controllers;

use App\Models\MyLink;
use App\Models\TextBlock;
use Illuminate\Http\Request;

class TextBlockController extends Controller
{
    public function index(Request $request, $mylinkId)
    {
        $mylink = MyLink::where('id', $mylinkId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $textBlocks = $mylink->textBlocks;
        return response()->json($textBlocks);
    }

    public function store(Request $request, $mylinkId)
    {
        $mylink = MyLink::where('id', $mylinkId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'font' => 'string|nullable',
            'alignment' => 'in:left,center,right',
            'bold' => 'boolean',
            'italic' => 'boolean',
            'color' => 'string|nullable',
        ]);

        $validated['mylink_id'] = $mylink->id;

        $textBlock = TextBlock::create($validated);
        return response()->json($textBlock, 201);
    }

    public function update(Request $request, $mylinkId, $id)
    {
        $mylink = MyLink::where('id', $mylinkId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $textBlock = TextBlock::where('id', $id)
            ->where('mylink_id', $mylink->id)
            ->firstOrFail();

        $validated = $request->validate([
            'title' => 'string|max:255',
            'font' => 'string|nullable',
            'alignment' => 'in:left,center,right',
            'bold' => 'boolean',
            'italic' => 'boolean',
            'color' => 'string|nullable',
        ]);

        $textBlock->update($validated);
        return response()->json($textBlock);
    }

    public function destroy(Request $request, $mylinkId, $id)
    {
        $mylink = MyLink::where('id', $mylinkId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $textBlock = TextBlock::where('id', $id)
            ->where('mylink_id', $mylink->id)
            ->firstOrFail();

        $textBlock->delete();
        return response()->json(['message' => 'Text block deleted successfully']);
    }
}
