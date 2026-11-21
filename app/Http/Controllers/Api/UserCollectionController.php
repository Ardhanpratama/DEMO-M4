<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserCollectionController extends Controller
{
    public function index(User $user)
    {
        $media = $user->media()->latest('media.created_at')->get();

        return MediaResource::collection($media);
    }

    public function store(User $user, Media $media): JsonResponse
    {
        if ($user->media()->whereKey($media->id)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada dalam koleksi pengguna.',
            ], 409);
        }

        $user->media()->attach($media->id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi.',
            'data' => new MediaResource($media),
        ], 201);
    }

    public function destroy(User $user, Media $media): JsonResponse
    {
        $deleted = $user->media()->detach($media->id);

        if ($deleted === 0) {
            return response()->json([
                'message' => 'Media tidak ditemukan dalam koleksi pengguna.',
            ], 404);
        }

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi.',
        ]);
    }
}
