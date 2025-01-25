<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\RakRequest;
use App\Models\Sdt\Rak;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'raks' => Rak::withCount('devices')->get(),
        ], 200);
    }

    public function store(RakRequest $request): JsonResponse
    {
        $rak = Rak::create($request->all());
        return response()->json([
            'success' => true,
            'rak' => $rak,
        ], 201);
    }

    public function show(Rak $rak): JsonResponse
    {
        return response()->json([
            'success' => true,
            'rak' => $rak
        ], 200);
    }

    public function update(RakRequest $request, Rak $rak): JsonResponse
    {
        $rak->update($request->all());
        return response()->json([
            'success' => true,
            'rak' => $rak
        ], 200);
    }

    public function destroy(Rak $rak): JsonResponse
    {
        return response()->json([
            'success' => $rak->delete()
        ], 200);
    }
}
