<?php 

class Formate{

    public function makeDate($date){
        return date('F j,Y,g:i a',strtotime($date));
    }
    
    public function shortext($text,$limit = 400){
            $text = $text." ";
            $text = substr($text,0,$limit);
            $text = substr($text,0,strrpos($text," "));
            $text = $text."...";
            return $text;
    }

    public function validation($data)
    {
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($this->db->conn, $data);
        return $data;
    }
}
