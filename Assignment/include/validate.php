<?php
class validate{
    public function validation($data, $fields){
        $msg = null;
        foreach($fields as $value){
            if(!isset($data[$value]) || empty($data[$value])){
                $msg= "<p> $value field empty </p>";
            }
        }
        return $msg;
    }
    //Check to see the age is valid
    public function age_validation($age){
        //Checking the age is numeric
        if(preg_match("/^[1-9][0-9]*$/",$age)){
            return true;
        }
        return false;
    }
    //Check to see if the mail is valid.
    public function email_validation($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    public function grade_validation($grade){
        // Check if grade is numeric and within range 0-100
        if(is_numeric($grade) && $grade >= 0 && $grade <= 100){
            return true;
        }
        return false;
    }

    //Check if address is valid (not empty and reasonable length)
    public function address_validation($address){
        // Check if address is not empty and has minimum reasonable length
        $address = trim($address);
        if(!empty($address) && strlen($address) >= 5){
            return true;
        }
        return false;
    }

    //Check if student ID is valid (exactly 5 numeric characters)
    public function student_id_validation($student_id){
        // Check if student ID is exactly 5 digits
        if(preg_match("/^[0-9]{5}$/",$student_id)){
            return true;
        }
        return false;
    }
}
