<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PostService;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Constructor
     */
    private $postService;
    public function __construct(PostService $postService){
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = $this->postService->getAll();
            return response()->json([
               'status' => true,
               'code'   => Response::HTTP_OK,
               'posts' => $posts->items(),
               'meta' => [
                   'total'=>$posts->total(),
                   'perPage'=> $posts->perPage(),
                   'currentPage'=> $posts->currentPage(),
               ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try{
            $post = $this->postService->save([
                'title'=> $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
            ]);
            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'post' => $post,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $post = $this->postService->findById($id);
            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'post' => $post,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        try{
            $post = $this->postService->save([
                'title'=> $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
            ], $id);
            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
                'post' => $post,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->postService->delete([$id]);
            return response()->json([
                'status' => true,
                'code'   => Response::HTTP_OK,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }
}
