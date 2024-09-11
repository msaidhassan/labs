<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Pagination\LengthAwarePaginator;
// use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model

{
    // public $id;
    // public $title;
    // public $posted_by;
    // public $created_at;
    use HasFactory ,SoftDeletes;
    use Sluggable;

    // protected static $file = 'posts.json';
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'posted_by', 'image', 'slug'];
    protected $dates = ['deleted_at'];

    public function user()
{
    return $this->belongsTo(User::class, 'posted_by');
}
    public function getHumanReadableDateAttribute()
    {
        $createdAt = $this->created_at ? Carbon::parse($this->created_at)->diffForHumans(['parts' => 3, 'join' => ', ']) : null;

        // Format deleted_at if it exists, otherwise return null
        $deletedAt = $this->deleted_at ? Carbon::parse($this->deleted_at)->diffForHumans(['parts' => 3, 'join' => ', ']) : null;

        // Return the relevant formatted date based on the context (created or deleted)
        return $deletedAt ?: $createdAt; 
        }
        public function comments(): MorphMany
        {
            return $this->morphMany(Comment::class, 'commentable');
        }
        public function sluggable(): array
        {
            return [
                'slug' => [
                    'source' => 'title'
                ]
            ];
        }   

    // public static function all()
    // {
    //     $data = Storage::disk('local')->get(self::$file);
    //     return json_decode($data, true);
    // }

    // public static function find($id)
    // {
    //     $posts = self::all();
    //     return collect($posts)->firstWhere('id', $id);
    // }

    // public static function store($post)
    // {
    //     $posts = self::all();
    //     if (is_array($posts) && !empty($posts)) {
    //         $post['id'] = end($posts)['id'] + 1;
    //     } else {
    //         // Handle the case where $posts is not an array or is empty
    //         $post['id'] = 1; // Start with ID 1 or any default value
    //     }
    //     $post['created_at'] = now()->format('Y-m-d H:i:s');
    //     $posts[] = $post;
    //     Storage::disk('local')->put(self::$file, json_encode($posts, JSON_PRETTY_PRINT));
    // }

    // public function update($id, $data)
    // {
    //     $posts = $this->all();
    //     foreach ($posts as &$post) {
    //         if ($post['id'] == $id) {
    //             $post = array_merge($post, $data);
    //             Storage::put(self::$file, json_encode($posts));
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // public static function delete($id)
    // {
    //     $posts = self::all();
    //     $posts = array_filter($posts, fn($post) => $post['id'] != $id);
    //     Storage::disk('local')->put(self::$file, json_encode(array_values($posts), JSON_PRETTY_PRINT));
    // }

    // public static function paginate($perPage = 5, $page = null)
    // {
    //     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

    //     $posts = self::all();
    //     $total = count($posts);
    //     $posts = array_slice($posts, ($page - 1) * $perPage, $perPage);

    //     return self::createPaginator($posts, $total, $perPage, $page, [
    //         'path' => Paginator::resolveCurrentPath(),
    //     ]);
    // }

    // protected static function createPaginator(array $items, $total, $perPage, $currentPage, array $options)
    // {
    //     return new \Illuminate\Pagination\LengthAwarePaginator($items, $total, $perPage, $currentPage, $options);
    // }
}
