<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Node;
use App\Models\Plan;

class MigrateFromXboard extends Command
{
    protected $signature = 'pboard:migrate {--db-host= : Xboard DB Host} {--db-name= : Xboard DB Name} {--db-user= : Username} {--db-pass= : Password}';
    protected $description = 'Migrate data from Xboard/V2board to Pboard seamlessly';

    public function handle()
    {
        $this->info('🚀 Starting Pboard Migration...');

        $config = [
            'host' => $this->option('db-host') ?? '127.0.0.1',
            'database' => $this->option('db-name'),
            'username' => $this->option('db-user') ?? 'root',
            'password' => $this->option('db-pass') ?? '',
            'driver' => 'mysql',
        ];

        if (empty($config['database'])) {
            $this->error('❌ Please provide --db-name');
            return 1;
        }

        try {
            config(['database.connections.xboard_migration' => array_merge($config, ['prefix' => ''])]);
            $this->info("🔌 Connected to {$config['host']}/{$config['database']}");
            
            // Clear cache to apply config
            DB::purge('xboard_migration');
            $this->migrateUsers();
            $this->migratePlans();
            $this->migrateNodes();
            
            $this->info('✅ Migration completed!');
        } catch (\Exception $e) {
            $this->error('❌ Migration failed: ' . $e->getMessage());
            return 1;
        }
    }

    protected function migrateUsers()
    {
        $this->info('📦 Migrating Users...');
        $users = DB::connection('xboard_migration')->table('v2_user')->get();
        $count = 0;
        foreach ($users as $old) {
            User::updateOrCreate(
                ['email' => $old->email],
                [
                    'uuid' => $old->uuid ?? Str::uuid()->toString(),
                    'password' => $old->password,
                    'plan_id' => $old->plan_id,
                    'expired_at' => $old->expired_at ? date('Y-m-d H:i:s', $old->expired_at) : null,
                    'transfer_enable' => $old->transfer_enable,
                    'u' => $old->u,
                    'd' => $old->d,
                    'banned' => $old->banned,
                    'remarks' => $old->remarks,
                ]
            );
            $count++;
        }
        $this->info("✅ Migrated {$count} users.");
    }

    protected function migratePlans()
    {
        $this->info('📦 Migrating Plans...');
        $plans = DB::connection('xboard_migration')->table('v2_plan')->get();
        $count = 0;
        foreach ($plans as $old) {
            Plan::updateOrCreate(
                ['id' => $old->id],
                [
                    'name' => $old->name,
                    'price' => $old->price,
                    'transfer_enable' => $old->transfer_enable,
                    'capacity' => $old->capacity ?? 0,
                    'speed_limit' => $old->speed_limit ?? 0,
                    'renew' => $old->renew ?? 1,
                ]
            );
            $count++;
        }
        $this->info("✅ Migrated {$count} plans.");
    }

    protected function migrateNodes()
    {
        $this->info('📦 Migrating Nodes (Smart Merge)...');
        $tables = DB::connection('xboard_migration')->select("SHOW TABLES LIKE 'v2_server_%'");
        $count = 0;
        foreach ($tables as $t) {
            $tableName = array_values((array)$t)[0];
            $nodes = DB::connection('xboard_migration')->table($tableName)->get();
            $protocol = str_replace('v2_server_', '', $tableName);

            foreach ($nodes as $old) {
                $config = json_encode([
                    'network' => $old->network ?? 'tcp',
                    'networkSettings' => json_decode($old->networkSettings ?? '{}', true),
                    'tlsSettings' => json_decode($old->tlsSettings ?? '{}', true),
                ]);

                \App\Models\Node::updateOrCreate(
                    ['name' => $old->show_name ?? "Node-{$old->id}"],
                    [
                        'group' => $old->group,
                        'host' => $old->host,
                        'port' => $old-> port,
                        'server_port' => $old->server_port ?? 0,
                        'protocol' => $protocol,
                        'config' => $config,
                        'enabled' => $old->show ?? 1,
                        'node_order' => $old->sort ?? 0,
                    ]
                );
                $count+=;
            }
        }
        $this->info("✅ Merged {$count} nodes.");
    }
}
