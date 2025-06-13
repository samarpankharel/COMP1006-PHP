<?php
// initializing the classes
include_once("include/crud.php");
include_once("include/validate.php");

//Creating the Class objects
$crud = new crud();
$validation = new validate();

if(isset($_POST['submit'])){
    //Using our escape_string function
    $name = $crud->escapeString($_POST['name']);
    $email = $crud->escapeString($_POST['email']);
    $address = $crud->escapeString($_POST['address']);
    $grade = $crud->escapeString($_POST['grade']);
    $age = $crud->escapeString($_POST['age']);
    $date = $crud->escapeString($_POST['date']);
    $student_id = $crud->escapeString($_POST['student_id']);

    // Using our function for validation in validate class (Validation)
    $msg = $validation->validation($_POST, array('name','email','address','grade','student_id','age','date'));

    // Individual field validations
    $checkEmail = $validation->email_validation($email);
    $checkAddress = $validation->address_validation($address);
    $checkGrade = $validation->grade_validation($grade);
    $checkStudentId = $validation->student_id_validation($student_id);

    // Check if all validations pass
    if(empty($msg) && $checkEmail && $checkAddress && $checkGrade && $checkStudentId){
        // All validations passed - proceed with data processing
        echo "<p>All validations passed! Data is valid.</p>";

        // INSERT DATA INTO DATABASE
        $insertQuery = "INSERT INTO students (name, age, student_id, address, email, date, grade) 
                        VALUES ('$name', '$age', '$student_id', '$address', '$email', '$date', '$grade')";

        if($crud->execute($insertQuery)){
            echo "<p>Student record added successfully to database!</p>";
        } else {
            echo "<p>Error: Failed to add student record to database.</p>";
        }

    } else {
        // Display validation errors
        if(!empty($msg)){
            echo $msg; // Shows empty field errors
        }

        if(!$checkEmail){
            echo "<p>Invalid email format</p>";
        }

        if(!$checkAddress){
            echo "<p>Address must be at least 5 characters long</p>";
        }

        if(!$checkGrade){
            echo "<p>Grade must be between 0 and 100</p>";
        }

        if(!$checkStudentId){
            echo "<p>Student ID must be exactly 5 numeric characters</p>";
        }
    }
}
?>