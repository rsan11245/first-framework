<?php
namespace application\models;
use application\core\Model;

class Main extends Model{

    public function getNews() {
        return $this->db->row('SELECT title, `text` from news');
    }

}