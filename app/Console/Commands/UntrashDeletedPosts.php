<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;
class UntrashDeletedPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:untrash-deleted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Untrash soft-deleted Posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $untrashedPosts = Post::onlyTrashed()
        ->where('deleted_at', '<', Carbon::now())
        ->get();

      foreach($untrashedPosts as $post){
         $post->restore();
      }

      $this->info('Soft-deleted Posts Untrashed Successfully!');

    }
}
