<?php

namespace Libraries\Console;

use Exception;
use Libraries\Database\DB;
use Libraries\Storage;

class Console extends Styling
{
    public function run()
    {
        try {
            $this->execute();
        } catch (\Throwable $th) {
            $this->setError();
            $this->println("!!! Kesalahan: " . $th->getMessage());
            $this->setDefault();
        }
    }

    private function execute()
    {
        $this->setInfo();
        $this->print("===================================");
        $this->println("==    Assalamu'alaikum Wr. Wb.   ==");
        $this->println("===================================");
        $this->println("======= ARDIS BY KELOMPOK 1 =======");
        $this->println("===================================");
        $this->println("Developer : Isnu, Zhen, Elly, Nurul");
        $this->println("===================================");
        $this->br();

        $this->setWarning();

        $this->println("Menyiapkan Berkas .env ...");
        $this->env();

        $this->println("Mengatur Tabel & Database ...");
        $this->migration();

        $this->br();
        $this->setSuccess();
        $this->println("Selesai.\nTotal Waktu (mikrodetik) : " . load_time());
        $this->setDefault();
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
            EOD;

            Storage::root()->put('.env', $default_value);
        }
    }

    private function migration()
    {
        try {
            DB::begin();

            //User Models
            $migrates = array_diff(scandir(MIGRATION_DIR), ['.', '..']);
            foreach($migrates as $file)
            {
                $name = preg_replace("/^(\d*_)(.*)(\.php)/", "$2", $file);
                $migrate = require_once(MIGRATION_DIR . $file);
                $migrate->execute($name);
            }

            DB::commit();
        } catch (Exception $th) {
            DB::rollback();
            throw new Exception($th->getMessage());
        }
    }
    
}