<?php

declare(strict_types=1);

namespace Blog;

use Blog\Models\Album;
use Blog\Models\Comment;
use Blog\Models\Photo;
use Blog\Models\Article;
use Blog\Models\ToDo;
use Blog\Models\User;
use Exception;
use GuzzleHttp\Client;

class PlaceholderClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com/',
        ]);
    }

    public function getAllArticles(): array
    {
        try {
            $postsCollection = [];

            if (!Cache::has(md5('posts'))) {
                $responseJson = $this->client->request('GET', 'posts')->getBody()->getContents();
                Cache::remember(md5('posts'), $responseJson, 120);
            } else {
                $responseJson = Cache::get(md5('posts'));
            }
            $posts = json_decode($responseJson,);

            foreach ($posts as $key => $post) {
                $postsCollection[] = new Article(
                    $this->getUserById($post->userId),
                    $post->id,
                    $post->title,
                    $post->body,
                );
            }

            return $postsCollection;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getUserById($id): ?User
    {
        try {
            if (!Cache::has(md5("singleuser/$id"))) {
                $responseJson = $this->client->request('GET', "users/$id")->getBody()->getContents();
                Cache::remember(md5("singleuser/$id"), $responseJson, 120);
            } else {
                $responseJson = Cache::get(md5("singleuser/$id"));
            }

            $author = json_decode($responseJson,);


            return new User(
                $author->id,
                $author->name,
                $author->username,
                $author->email,
                $author->address,
                $author->phone,
                $author->website,
                $author->company,
            );
        } catch (Exception $e) {
            return null;
        }
    }

    public function getArticleById(int $id): ?Article
    {
        try {
            if (!Cache::has(md5("singlepost/$id"))) {
                $responseJson = $this->client->request('GET', 'posts/' . $id)->getBody()->getContents();
                Cache::remember(md5("singlepost/$id"), $responseJson, 120);
            } else {
                $responseJson = Cache::get(md5("singlepost/$id"));
            }
            $post = json_decode($responseJson,);

            return new Article(
                $this->getUserById($post->userId),
                $post->id,
                $post->title,
                $post->body,
            );
        } catch (Exception $e) {
            return null;
        }
    }

    public function getArticlesByUserId(int $id): array
    {
        try {
            $postsCollection = [];
            if (!Cache::has(md5("postsbyuser/$id"))) {
                $responseJson = $this->client->request('GET', 'posts?userId=' . $id)->getBody()->getContents();
                Cache::remember(md5("postsbyuser/$id"), $responseJson, 120);
            } else {
                $responseJson = Cache::get(md5("postsbyuser/$id"));
            }
            $posts = json_decode($responseJson,);

            foreach ($posts as $key => $post) {
                $postsCollection[] = new Article(
                    $this->getUserById($post->userId),
                    $post->id,
                    $post->title,
                    $post->body,
                );
            }

            return $postsCollection;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getAllUsers(): array
    {
        try {
            $authorsCollection = [];
            if (!Cache::has(md5("users"))) {
                $responseJson = $this->client->request('GET', 'users')->getBody()->getContents();
                Cache::remember(md5("users"), $responseJson, 120);
            } else {
                $responseJson = Cache::get(md5("users"));
            }
            $authors = json_decode($responseJson,);


            foreach ($authors as $key => $author) {
                $authorsCollection[] = new User(
                    $author->id,
                    $author->name,
                    $author->username,
                    $author->email,
                    $author->address,
                    $author->phone,
                    $author->website,
                    $author->company,
                );
            }

            return $authorsCollection;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getCommentsByArticleId($id): array
    {
        try {
            $commentsCollection = [];

            if (!Cache::has(md5("comments/$id"))) {
                $responseJson = $this->client->request('GET', 'posts/' . $id . '/comments')
                    ->getBody()->getContents();
                Cache::remember(md5("comments/$id"), $responseJson, 120);
            } else {
                $responseJson = Cache::get(md5("comments/$id"));
            }
            $comments = json_decode($responseJson,);

            foreach ($comments as $key => $comment) {
                $commentsCollection[] = new Comment(
                    $comment->postId,
                    $comment->id,
                    $comment->name,
                    $comment->email,
                    $comment->body,
                );
            }

            return $commentsCollection;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getAlbumsById($id): array
    {
        try {
            $albumsCollection = [];

            if (!Cache::has(md5("albums/$id"))) {
                $responseJson = $this->client->request('GET', 'users/' . $id . '/albums')
                    ->getBody()->getContents();
                Cache::remember(md5("albums/$id"), $responseJson, 120);
            } else {
                $responseJson = Cache::get(md5("albums/$id"));
            }
            $albums = json_decode($responseJson,);

            foreach ($albums as $key => $album) {
                $albumsCollection[] = new Album(
                    $album->userId,
                    $album->id,
                    $album->title,
                    $this->getPhotosByAlbumId($album->id),
                );
            }
            return $albumsCollection;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getPhotosByAlbumId($id): array
    {
        try {
            $photosCollection = [];

            if (!Cache::has(md5("photos/$id"))) {
                $responseJson = $this->client->request('GET', 'albums/' . $id . '/photos')
                    ->getBody()->getContents();
                Cache::remember(md5("photos/$id"), $responseJson, 120);
            } else {
                $responseJson = Cache::get(md5("photos/$id"));
            }
            $photos = json_decode($responseJson,);

            foreach ($photos as $key => $photo) {
                $photosCollection[] = new Photo(
                    $photo->albumId,
                    $photo->id,
                    $photo->title,
                    $photo->url,
                    $photo->thumbnailUrl,
                );
            }
            return $photosCollection;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getToDosByUserId($id): array
    {
        try {
            $toDosCollection = [];

            if (!Cache::has(md5("todos/$id"))) {
                $responseJson = $this->client->request('GET', 'users/' . $id . '/todos')->getBody()->getContents();
                Cache::remember(md5("todos/$id"), $responseJson, 120);
            } else {
                $responseJson = Cache::get(md5("todos/$id"));
            }
            $toDos = json_decode($responseJson,);

            foreach ($toDos as $key => $toDo) {
                $toDosCollection[] = new ToDo(
                    $toDo->userId,
                    $toDo->id,
                    $toDo->title,
                    $toDo->completed,
                );
            }
            return $toDosCollection;
        } catch (Exception $e) {
            return [];
        }
    }
}