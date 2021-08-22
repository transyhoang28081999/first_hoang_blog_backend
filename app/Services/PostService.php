<?php

namespace App\Services;

use App\Models\Post;

class PostService{
    //Save
    public function save(array $data, $id = null){
        return Post::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['user_id'],
            ]
        );
    }
    
    // Get all
    public function getAll($limit = 6){
        return Post::paginate($limit);
    }

    // find by id

    public function findById($id){
        return Post::find($id);
    }

    // Delete

    public function delete($id = []){
        return Post::destroy($id);
    }
}