<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Missions\Mission;
use Illuminate\Support\Facades\File;
use Spatie\Image\Image;

class MediaDimensions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archub:media_dimensions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store media dimensions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Mission::all() as $mission) {
            $photos = $mission->photos();

            foreach ($photos as $photo) {
                $path = $photo->getPath();
                if (File::exists($path)) {
                    $image = Image::load($path);
                    $width = $image->getWidth();
                    $height = $image->getHeight();
                    
                    $photo->setCustomProperty('width', $width);
                    $photo->setCustomProperty('height', $height);
                    $photo->save();
                } else {
                    $this->comment("{$mission->id} {$mission->display_name} {$path} is an invalid path");
                }
            }
            $this->comment("{$mission->id} {$mission->display_name} all photos updated");
        }
    }
}
