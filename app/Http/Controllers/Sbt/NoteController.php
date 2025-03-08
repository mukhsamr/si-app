<?php

namespace App\Http\Controllers\Sbt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sbt\NoteRequest;
use App\Http\Resources\Sbt\NoteResource;
use App\Models\Sbt\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteController extends Controller
{
    function index(Request $request): JsonResource
    {
        return NoteResource::collection($request->user()->notes()->with('student')->latest('updated_at')->get())
            ->additional([
                'message' => 'Get notes',
                'status' => 'success'
            ]);
    }

    function store(NoteRequest $request): JsonResource
    {
        $validated = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = str($file->getClientOriginalName())->slug();
            $file->storePubliclyAs('notes', $name);
            $validated['file'] = $name;
        }

        $note = $request->user()->notes()->create($validated);
        return NoteResource::make($note)
            ->additional([
                'message' => 'Note created',
                'status' => 'success'
            ]);
    }

    // function show(Note $note): JsonResponse
    // {
    //     return response()->json([
    //         'note' => $note,
    //         'message' => 'Get note'
    //     ], 200);
    // }

    function update(NoteRequest $request, Note $note): JsonResource
    {
        $validated = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = str($file->getClientOriginalName())->slug();
            $file->storePubliclyAs('notes', $name);
            $validated['file'] = $name;
        }

        $note->update($validated);
        return NoteResource::make($note)
            ->additional([
                'message' => 'Note updated',
                'status' => 'success'
            ]);
    }

    function destroy(Note $note): JsonResponse
    {
        $note->delete();
        return response()->json([
            'data' => null,
            'status' => 'success',
            'message' => 'Note deleted'
        ], 200);
    }
}
