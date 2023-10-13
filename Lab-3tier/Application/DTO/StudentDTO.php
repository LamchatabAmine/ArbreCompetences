<?php
/**
 * User: Arif Uddin
 * Date: 4/6/12
 * Time: 4:14 PM
 */
 
class StudentDTO {

    private $id;
    private $name;
    private $roll;
    private $email;
    private $dateOfBirth;

    function StudentDTO($id, $roll, $name, $email, $dateOfBirth) {
        $this->id = $id;
        $this->name = $name;
        $this->roll = $roll;
        $this->email = $email;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function GetId() { return $this->id; }
    public function GetName() { return $this->name; }
    public function GetRoll() { return $this->roll; }
    public function GetEmail() { return $this->email; }
    public function GetDateOfBirth() { return $this->dateOfBirth; }
}
