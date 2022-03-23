<?php

// Authentication
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['auth'] == "false") {
    header("Location: ./../login.html");
    exit();
}
require_once("./../contactHandler.php");

$contactManager = new ContactManager();
 if(isset($_POST['search']) && $_POST['search'] != "") {
    $allContacts = $contactManager->getContactsBirthdayBySearch($_POST['search']);    
    } else { $allContacts = $contactManager->getContactsByBirthday();
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contact Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./../../wwwroot/css/site.css">
	</head>
	<body>

        <header>
            <div class=" container">
                <nav class="navbar navbar-expand navbar-light">
                    <a class="navbar-brand " href="./../allContacts/allContacts.php">Contact Management System</a>
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="./../allContacts/allContacts.php">Contacts</a>
                            <a class="nav-item nav-link active" href="#">Calendar</a>
                            <a class="nav-item nav-link btn btn-danger btn-sm mx-5" href="./../Logout/logout.php">Logout</a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>


        <div class="container ">
            <form action="calendar.php" method="POST" class="container mt-0">
                <input type="text" name="search" id="search" class="w-75 search-bar text-dark border-0 text-center" placeholder="Search a contact" />
                <input type="submit" class="w-25 btn btn-primary m-3" value="Search" />
            </form>
        </div>
        
        <div class="container">

            <!------------------------------------------>
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <link rel="stylesheet" href="./../../wwwroot/css/site.css">
            <div class="container">

            <div class="table-responsive">
                <table class="table user-list">
                    <?php if(!empty($allContacts)) { ?>
                        <thead>
                            <tr>
                                <th class="text-center"><span>Birthday</span></th>
                                <th><span>Name</span></th>
                                <th><span>Days left</span></th>
                            </tr>
                            
                        </thead id="userData">
                        <tbody>
                    <?php if(!empty($allContacts)) foreach($allContacts as $k => $contact) { ?>

                        <tr>
                            <td class="birthday">
                            <?php 

                            $day   = explode("-", $contact->birthday)[2];
                            $month = explode("-", $contact->birthday)[1];
                            $year  = explode("-", $contact->birthday)[0];
                            
                            $birthday = date("M d", mktime(0, 0,0, $month, $day,$year ));
                            echo $birthday
                            ?>
                            </td>

                            <td class="birthday"><a href="#" class="user-link">
                                <?php echo $contact->firstName ?>
                                <?php echo $contact->lastName ?>
                            </a></td>
                            <td class="birthday">
                                <?php 
                                    $birthdate = date($contact->birthday);
                                    $current_date = date("Y-m-d");  

                                    $birth_time = strtotime($birthdate);
                                    $current_time = strtotime($current_date);

                                    $arr1 = explode("-", $birthdate);                                    
                                    $year1 = $arr1[0];

                                    $arr2 = explode("-", $current_date);
                                    $year2 = $arr2[0];

                                    $year_diff = $year2-$year1;
                                    $time_new = strtotime("+".$year_diff." year", $birth_time);

                                    if($time_new<$current_time) {
                                        $time_new = strtotime("+1 year", $time_new);
                                    } $time_diff = $time_new - $current_time;

                                    $days = $time_diff/86400;
                                    echo $days; 
                                
                                ?>
                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } 
            else { ?>
                <div class="h3">No records to display</div>
            <?php } ?>
                        
            </div>
        </div>

    </body>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="./../../wwwroot/js/site.js"></script>

</html>
