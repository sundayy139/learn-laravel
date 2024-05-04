<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = QueryBuilder::for(Post::class)
            ->allowedFilters('id', 'title', 'metaTitle', 'authorId', 'parentId', 'sumary', 'createdAt', 'updatedAt', 'published')
            ->defaultSort('-id')
            ->allowedSorts(['id', 'title', 'metaTitle', 'authorId', 'createdAt', 'updatedAt', 'published'])
            ->paginate(env('PAGINATE'));

        return new PostCollection($post);
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
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $post = Auth::user()->posts()->create($validated);

            if ($request->has('tags')) {
                foreach ($request->tags as $tagName) {
                    $tag = Tag::firstOrCreate(['title' => $tagName]);
                    $post->tags()->attach($tag->id);
                }
            }

            if ($request->has('categories')) {
                foreach ($request->categories as $categoryName) {
                    $category = Category::firstOrCreate(['title' => $categoryName]);
                    $post->categories()->attach($category->id);
                }
            }

            DB::commit();

            return new PostResource($post);
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json(['message' => 'Error occurred while saving post.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $post->update($validated);

            if ($request->has('tags')) {
                $tagIds = [];
                foreach ($request->tags as $tagName) {
                    $tag = Tag::firstOrCreate(['title' => $tagName]);
                    $tagIds[] = $tag->id;
                }

                $post->tags()->sync($tagIds);
            } else {
                $post->tags()->detach();
            }

            if ($request->has('categories')) {
                $categoryIds = [];
                foreach ($request->categories as $categoryName) {
                    $category = Category::firstOrCreate(['title' => $categoryName]);
                    $categoryIds[] = $category->id;
                }

                $post->categories()->sync($categoryIds);
            } else {
                $post->categories()->detach();
            }

            DB::commit();

            return new PostResource($post);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Error occurred while updating post.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ]);
    }
}
