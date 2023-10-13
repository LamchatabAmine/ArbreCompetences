<?php

/**
 * Class for database interaction
 */
class StudentDAL {

    private $db;
    private $databaseConnectionObj;

    /**
     * Connect to the database. Create an instance of database object.
     */
    public function StudentDAL() {
        $this->databaseConnectionObj = new DatabaseConnection();
        $this->db = $this->databaseConnectionObj->GetDB();
    }

    /**
     * Get All students
     *
     * @return array
     */
    public function GetAllStudents() {

        $listOfStudentDto = array();
        $sql = "SELECT * FROM Student";
        $raw_result = $this->db->get_results($sql, ARRAY_A);

        if(count($raw_result) > 0){
            for($i=0; $i<count($raw_result); $i++) {

                $id = $raw_result[$i]['Id'];
                $roll = $raw_result[$i]['Roll'];
                $name = $raw_result[$i]['Name'];
                $email = $raw_result[$i]['Email'];
                $dateOfBirth = $raw_result[$i]['DateOfBirth'];
                
                $listOfStudentDto[] = new StudentDTO($id, $roll, $name, $email, $dateOfBirth);
            }
        }

        return $listOfStudentDto;
    }

    /**
     * Get a student
     *
     * @param int $studentId
     * @return bool|\StudentDTO
     */
    public function GetStudent($studentId) {

        $sql = "SELECT * FROM Student WHERE Id=". $studentId;
        $aStudent = $this->db->get_row($sql, ARRAY_A);

        if(is_array($aStudent) && count($aStudent) > 0) {
            $studentDtoObj = new StudentDTO($aStudent['Id'], $aStudent['Roll'], $aStudent['Name'], $aStudent['Email'], $aStudent['DateOfBirth']);
            return $studentDtoObj;
        }

        return false;
    }

    /**
     * Insert New Student
     *
     * @param object $studentDto
     * @return int
     */
    public function AddStudent($studentDto) {

        $sql = "INSERT INTO Student (`Roll`, `Name`, `Email`, `DateOfBirth`)
                VALUES (
                  '". $studentDto->GetRoll() ."',
                  '". $studentDto->GetName() ."',
                  '". $studentDto->GetEmail() ."',
                  '". $studentDto->GetDateOfBirth() ."'
                )";
        $this->db->query($sql);

        return $this->db->insert_id;
    }

    /**
     * Updates existing Student
     *
     * @param object $studentDto
     * @return bool|int
     */
    public function UpdateStudent($studentDto) {

        $sql = "UPDATE Student
                SET
                    Roll='". $studentDto->GetRoll() ."',
                    Name='". $studentDto->GetName() ."',
                    Email='". $studentDto->GetEmail() ."',
                    DateOfBirth='". $studentDto->GetDateOfBirth() ."'
                WHERE Id=". $studentDto->GetId();

        return $this->db->query($sql);
    }

    /**
     * Search Student By Name
     *
     * @param string $studentName
     * @return array
     */
    public function SearchStudentByName($studentName) {

        $sql = "SELECT * FROM student WHERE Name LIKE '%". $studentName ."%'";

        $searchStudent = $this->db->get_results($sql, ARRAY_A);
        $listOfStudentDto = array();

        if(count($searchStudent) > 0){
            for($i=0; $i<count($searchStudent); $i++) {

                $id = $searchStudent[$i]['Id'];
                $roll = $searchStudent[$i]['Roll'];
                $name = $searchStudent[$i]['Name'];
                $email = $searchStudent[$i]['Email'];
                $dateOfBirth = $searchStudent[$i]['DateOfBirth'];

                $listOfStudentDto[] = new StudentDTO($id, $roll, $name, $email, $dateOfBirth);
            }
        }

        return $listOfStudentDto;
    }

    /**
     * Deletes a student from the database
     *
     * @param $studentId
     * @return int|void
     */
    public function DeleteStudent($studentId) {

        $sql = "DELETE FROM Student WHERE Id=". $studentId;

        return $this->db->query($sql);
    }

    /**
     * Checks whether given Roll exists or not
     *
     * @param string $roll
     * @param int $id
     * @return bool
     */
    public function IsRollExists($roll, $id=0) {

        $sql = "SELECT * FROM Student WHERE Roll='". $roll ."' AND Id != $id";
        $raw_result = $this->db->get_row($sql, ARRAY_A);

        if( count($raw_result) > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks whether given Id exists or not
     *
     * @param int $id
     * @return bool
     */
    public function IsIdExists($id) {

        $sql = "SELECT * FROM Student WHERE Id = $id";
        $raw_result = $this->db->get_row($sql, ARRAY_A);

        if( count($raw_result) > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks whether given Email exists or not
     *
     * @param string $email
     * @param int $id
     * @return bool
     */
    public function IsEmailExists($email, $id=0) {

        $sql = "SELECT * FROM Student WHERE Email='". $email ."' AND Id != $id";
        $raw_result = $this->db->get_row($sql, ARRAY_A);

        if( count($raw_result) > 0 ) {
            return true;
        } else {
            return false;
        }
    }
}