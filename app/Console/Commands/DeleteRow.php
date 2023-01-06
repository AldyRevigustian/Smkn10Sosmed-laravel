<?php

namespace App\Console\Commands;

use App\Models\ImageStory;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DeleteRow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-row';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        Story::where('updated_at', '<=', Date::now()->format('Y-m-d H:i:s'))->delete();
        ImageStory::where('created_at', '<=', Date::now()->format('Y-m-d H:i:s'))->delete();
        return 0;
    }
}
