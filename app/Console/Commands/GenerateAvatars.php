<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateAvatars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'avatar:generate {--test : Test avatar generation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and test DiceBear avatars for anime characters';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🎨 Generating DiceBear Avatar URLs...');

        $avatars = [
            'anime-1' => 'Adventurer Hero',
            'anime-2' => 'Magical Girl',
            'anime-3' => 'Smart Scholar',
            'anime-4' => 'Mystic Warrior',
            'anime-5' => 'Cat Lover',
            'anime-6' => 'Dark Knight',
            'anime-7' => 'Princess',
            'anime-8' => 'Ninja Master',
            'anime-9' => 'Forest Guardian',
            'anime-10' => 'Fire Mage',
            'anime-11' => 'Ice Queen',
            'anime-12' => 'Thunder God',
        ];

        $this->table(['Seed', 'Name', 'URL'], collect($avatars)->map(function ($name, $seed) {
            return [
                $seed,
                $name,
                "https://api.dicebear.com/7.x/adventurer/{$seed}.svg"
            ];
        })->toArray());

        if ($this->option('test')) {
            $this->info('🧪 Testing avatar accessibility...');

            foreach ($avatars as $seed => $name) {
                $url = "https://api.dicebear.com/7.x/adventurer/{$seed}.svg";

                // Test if URL is accessible (basic check)
                $headers = @get_headers($url);
                $accessible = $headers && strpos($headers[0], '200') !== false;

                $status = $accessible ? '✅' : '❌';
                $this->line("{$status} {$name} ({$seed})");
            }
        }

        $this->info('✨ Avatar generation complete!');
        return 0;
    }
}
