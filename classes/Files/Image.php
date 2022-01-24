<?php


class Image
{
    private $imgtype;
    private $imgsize;
    private $maximgsize;
    private $validtype;

    public function __construct() {

        $fileconfigPath = ROOT.'/config/files.php';
        $config = include($fileconfigPath);
        $this->validtype = $config['types'];
        $this->maximgsize = $config['maximgsize'];
    }

    public function checkValid($img) {

        if (($img['size'] < $this->maximgsize) && (in_array($img['type'], $this->validtype))) {
            return true;
        } else {
            return false;
        }
    }

//    public function upload($img_tmp) {
//
//        $img = addslashes(file_get_contents($img_tmp));
//
//        require_once ROOT.'/classes/DB/DB.php';
//
//        $DB = new DB;
//        $DBh = $DB->connect();
//
//        $sql = 'INSERT INTO users(img)
//                VALUES (:img)';
//
//        $query = $DBh->prepare($sql);
//        $query->execute(array('img' => $img));
//
//        $user = $query->fetch();
//
//        return true;
//    }



}