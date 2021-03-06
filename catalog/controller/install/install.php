<?php

Class ControllerInstallInstall extends Controller
{
    public function index()
    {
        $this->createFolder('sifrex.com');
    }

    public function createTenant()
    {
        // Create database and user
        //$this->createDatabase();
        // Install demodata
        /* */
        //Create demo folder

    }


    public function createDatabase()
    {
        $pass = $this->randomPassword();
        $dbname = $this->generateRandomString();
        try {
            $this->db->query("CREATE DATABASE `$dbname`");
            $this->db->query("CREATE USER '$dbname'@'localhost' IDENTIFIED BY '" . $pass . "'");
            $this->db->query("GRANT ALL ON `$dbname`.* TO '$dbname'@'localhost'");
            $this->db->query("FLUSH PRIVILEGES");
            echo 'Başarılı';

        } catch (PDOException $e) {
            echo "DB ERROR: " . $e->getMessage();
            return false;
        }
        return ['pwd' => $pass, 'dbname' => $dbname];
    }

    public function createFolder($domain){
        $this->xcopy('C:/xampp/htdocs/oc/repo/localhost','C:/xampp/htdocs/oc/repo/'.$domain);
    }

    public function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_^?/.%+-!=()';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 25; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function xcopy($source, $dest, $permissions = 0755)
    {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            $this->xcopy("$source/$entry", "$dest/$entry", $permissions);
        }

        // Clean up
        $dir->close();
        return true;
    }
}