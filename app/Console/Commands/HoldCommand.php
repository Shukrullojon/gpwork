<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\History;
use App\Models\Hold;
use App\Services\AbsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class HoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "hold";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hold';

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
        $holds = Hold::where('status',0)->get();
        foreach ($holds as $hold){
            $abs = AbsService::transaction(json_decode($hold->data));
            if (isset($abs['status']) and $abs['status']){
                $hold->update([
                    'state' => 1,
                    'response' => json_encode($abs,JSON_UNESCAPED_UNICODE)
                ]);
            }
        }
        return 0;
    }
}
