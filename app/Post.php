<?php

class Post {
    public function store($title, $content) {
        $post = Post::create([
            'title' => $title,
            'content' => $content
        ]);
        return $post;
    }
}