<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\QueryBuilder;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheKey = 'tags';

        if (Cache::has( $cacheKey)){
            $tags = Cache::get( $cacheKey);
        }
         else {
            $tags = QueryBuilder::for(Tag::class)
            ->allowedFilters('id','title', 'metaTitle')
            ->defaultSort('-id')
            ->allowedSorts(['id', 'title', 'metaTitle'])
            ->paginate(env('PAGINATE'));

            Cache::forever($cacheKey, $tags);
        }

        return new TagCollection($tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
 
        $validated = $request->validated();

        $tag = Tag::create($validated);
        
        return new TagResource($tag);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $validated = $request->validated();

        $tag->update($validated);

        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag -> delete();

        return response()-> json([
            'success' => true,
            'message' => 'Tag deleted successfully'
        ]);
    }
}
