<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\History;
use App\Models\Hold;
use App\Models\Transfer;
use App\Services\AbsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CommissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "commission";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commission command';

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
        $transfers = Transfer::where('status',4)->where('is_commission',0)->get();
        $account = Account::where('type',2)->first();
        foreach ($transfers as $transfer){
            $account->update([
                'balance' => $account->balance - $transfer->commission_amount
            ]);
            $transfer->update([
                'is_commission' => 1,
            ]);
        }
        return 0;
    }
}
