<?php

namespace App\Http\Controllers\Sbt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sbt\NoteRequest;
use App\Models\Sbt\Note;
use App\Models\Sbt\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    function index(Request $request): JsonResponse
    {
        return response()->json([
            'notes' => $request->user()->notes()->latest()->get(),
            'message' => 'Get all notes'
        ], 200);
    }

    function store(NoteRequest $request): JsonResponse
    {
        $note = $request->user()->notes()->create($request->all());
        return response()->json([
            'note' => $note,
            'message' => 'Note created'
        ], 200);
    }

    function show(Note $note): JsonResponse
    {
        return response()->json([
            'note' => $note,
            'message' => 'Get note'
        ], 200);
    }

    function update(NoteRequest $request, Note $note): JsonResponse
    {
        $note->update($request->all());
        return response()->json([
            'note' => $note,
            'message' => 'Note updated'
        ], 200);
    }

    function destroy(Note $note): JsonResponse
    {
        $note->delete();
        return response()->json([
            'message' => 'Note deleted'
        ], 200);
    }
}
