<?php

mysql_connect("127.0.0.1","jdbc:my.sql:://:3306/sl","root","123")



$ firstname = $_POST['firstname'];
$ lastname = $_POST['lastname'];
$ birthday = $_POST['birthday'];
$ birthmonth = $_POST['birthmonth'];
$ birthyear = $_POST['birthyear'];
$ email = $_POST['email'];
$ password = $_POST['password'];
$ phone = $_POST['phone'];
$ gender = $_POST['gender'];
$ age = $_POST['age'];
$ idea = $_POST['idea'];
$ city = $_POST['city'];
$ state = $_POST['state'];
$ country = $_POST['country'];


if (!empty($firstname) || !empty($lastname)|| !empty($birthday) ||
!empty($birthmonth) || !empty($birthyear) || !empty($email)) || !empty($password)) || !empty($phone)) || !empty($gender)) || !empty($age)) || !empty($city)) || !empty($state)) || !empty($country)) {
	$host = "localhost";
    $dbUsername = "root";
    $dbPassword = "123";
    $dbname = "sl";

    //create connection 
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connection_error()){
        die('Connect Error ('. mysqli_connect_errno ().')'.  mysqli_connect_error());
    }else {
    	$SELECT = "SELECT email From register Where email = ? Limit 1";
    	$INSERT = "INSERT Into register sl (firstname,lastname,birthday,birthmonth,birthyear,email,password,phone,gender,age,idea,city,state,country) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";


    	//Prepare statment
    	$stmt = $conn->prepare($SELECT);
    	$stmt->bind_param("s", $email);
    	$stmt->execute();
    	$stmt->bind_result();
    	$stmt->store_result();
    	$rnum = $stmt->num_rows;

    	if ($rnum==0){
    		$stmt->close();
    		
    		$stmt = $conn->prepare($INSERT);
    		$stmt->bind-param("ssssii" ,$firstname,$lastname,$birthday,$birthmonth,$birthyear,$email,$password,$phone,$gender,$age,$idea,$city,$state,$country);
    		$stmt->execute();
    		echo "New record inserted successfully";
    	} else{
    		echo "Someone already registered using this email";
    	}
    	$stmt->close();
    	$conn->close();
    }
} else {
	echo "All fields are required";
	die();
}

?>