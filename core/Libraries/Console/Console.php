<?php

namespace Libraries\Console;

use Exception;
use Libraries\Database\DB;
use Libraries\Database\Migration;
use Libraries\Interfaces\MigrationInterface;
use Libraries\Storage;

class Console extends Styling
{
    public function run()
    {
        error_reporting(0);
        global $argv;
        switch ($argv[1]) {
            case 'wipe':
                $this->execute('wipe');
                break;
            
            default:
                $this->execute();
                break;
        }
    }

    private function execute($method = 'default', ...$params)
    {
        try {
            $this->setInfo();
            $this->print("===================================");
            $this->println("==    Assalamu'alaikum Wr. Wb.   ==");
            $this->println("===================================");
            $this->println("======= ARDIS BY KELOMPOK 1 =======");
            $this->println("===================================");
            $this->println("Developer : Isnu, Zhen, Elly, Nurul");
            $this->println("===================================");
            $this->br();
            call_user_func_array([$this, $method], $params);
            $this->br();
            $this->setSuccess();
            $this->println("Selesai.\nTotal Waktu (mikrodetik) : " . load_time());
            $this->setDefault();
        } catch (\Throwable $th) {
            $this->setError();
            $this->println("!!! Kesalahan: " . $th->getMessage());
            $this->setDefault();
        }
    }

    private function default()
    {
        $this->setWarning();

        $this->println("Menyiapkan Berkas .env ...");
        $this->env();

        $this->println("Mengatur Tabel & Database ...");
        $this->migration();
    }

    private function env()
    {
        if(!Storage::root()->has('.env')) 
        {
            $default_value = <<<EOD
            APP_ENV = "development"

            # Tambahkan slash dibelakang (Jika Directory)
            BASE_URL = "http://localhost/uas/public/"
            
            # Konfigurasi Database
            DB_HOST = "localhost"
            DB_USER = "root"
            DB_PASS = ""
            DB_NAME = "kuliah"

            #INFO SEKOLAH
            SCHOOL_NAME = "SMKN 1 Berdaya"
            EOD;

            Storage::root()->put('.env', $default_value);
        }
    }

    private function migration()
    {
        $NOW = date('Y-m-d h:i:s');
        try {

            //Migration Init
            if(
                DB::table('information_schema.tables')->where('table_schema', config('db_name'))->where('table_name', 'migrations')->count() < 1
            )
            {
                $migration_table = new class extends Migration implements MigrationInterface
                {
                    public function run()
                    {
                        $this->integer('id')->autoIncrement()->primary();
                        $this->string('data');
                        $this->timestamp('run_at');
                    }
                };
                $migration_table->execute('migrations');
            }

            $migrated = DB::table('migrations')->get()->pluck('data')->toArray();

            //User Models
            $migrates = array_diff(scandir(MIGRATION_DIR), ['.', '..']);
            foreach($migrates as $file)
            {
                $name = preg_replace("/^(\d*_)(.*)(\.php)/", "$2", $file);
                if(in_array($name, $migrated)) continue;

                $migrate = require_once(MIGRATION_DIR . $file);
                $migrate->execute($name);

                DB::table('migrations')->insert([
                    'data' => $name,
                    'run_at' => $NOW
                ]);
            }

        } catch (Exception $th) {
            throw new Exception($th->getMessage());
        }
    }

    private function wipe($prompt = true)
    {
        $this->setWarning();

        $this->br();

        $result = "";
        if($prompt) while(!in_array($result, ['ya', 'tidak']))
        {
            $result = readline("Yakin ingin menghapus semua tabel di database \"".config('db_name')."@".config('db_host')."\" ? (ya|tidak) : ");
        }
        else
        {
            $result = 'ya';
        }

        if($result == "ya")
        {
            try {
                DB::begin();
                $tables = DB::table('information_schema.tables')->where('table_schema', config('db_name'))->get();

                DB::customQuery("SET FOREIGN_KEY_CHECKS = 0");
                foreach($tables as $table) DB::customQuery("DROP TABLE IF EXISTS " . $table->TABLE_NAME);
                DB::customQuery("SET FOREIGN_KEY_CHECKS = 0");
                
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                throw new Exception($th->getMessage());
            }
        }
    }
    
}