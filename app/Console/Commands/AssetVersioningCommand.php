<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Support\Str;

class AssetVersioningCommand extends Command
{
    use ConfirmableTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:version {--force : Force the operation to run when in production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an asset version identifier';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $key = $this->generateRandomKey();
        if (! $this->setKeyInEnvironmentFile($key)) {
            return;
        }
        $this->info('Asset version key set successfully.');
    }
    protected function generateRandomKey(): string
    {
        return Str::random(16);
    }
    protected function setKeyInEnvironmentFile($key)
    {
        $currentKey = $this->laravel[ 'config' ][ 'assets.version' ];

        if (strlen($currentKey) !== 0 && (! $this->confirmToProceed())) {
            return false;
        }

        $this->writeNewEnvironmentFileWith($key);

        return true;
    }
    protected function writeNewEnvironmentFileWith($key)
    {
        file_put_contents($this->laravel->environmentFilePath(), preg_replace(
            $this->keyReplacementPattern(),
            'ASSETS_VERSION=' . $key,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }
    protected function keyReplacementPattern()
    {
        $escaped = preg_quote('=' . $this->laravel[ 'config' ][ 'assets.version' ], '/');

        return "/^ASSETS_VERSION{$escaped}/m";
    }
}
