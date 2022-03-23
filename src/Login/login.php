<?php 

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    $auth = new UserAuth();
    $authenticated = $auth->login($email, $password);

    if($authenticated) {
        session_start();
        $_SESSION["auth"] = "true";
        header("Location: ./../allContacts/allContacts.php");
        exit();
    } else {
        $error = "Invalid login credentials";
    }
}
class UserAuth {

    private $connection = null;
    private $table_name = "user";
    
    public function __construct() {
        $config = parse_ini_file('./../../config.ini');
        //set up database and table names
        $db_name = $config['dbname'];
        //connect to MySQL and select database to use
        $this->connection = mysqli_connect($config['servername'], $config['username'], $config['password']) 
            or die(mysqli_error($connection));
        $db = mysqli_select_db($this->connection, $db_name) or die(mysqli_error($this->connection));
    }

    public function login($email, $password) {

        $statement = $this->connection->prepare("SELECT * FROM $this->table_name WHERE emailAddress = ? LIMIT 1");
        $statement->bind_param('s', $email);
        $statement->execute();
        $result = $statement->get_result();
        if($result->num_rows != 1) {
            $access = false;
        } else {
            $result->data_seek(0);
            $hash = $result->fetch_assoc()['password'];

            if(password_verify($password, $hash)) {
                $access = true;    
            } else {
                $hashed_password = password_hash('password', PASSWORD_DEFAULT);
                echo $hashed_password;
                $access = false;
            }
        } return $access;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="ms-auto me-auto" style="min-width: 300px; max-width: 500px">
        <div class="mx-4">
            <h1 class="my-4">Login</h1>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="text" name="email" maxlength=255>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" maxlength=10>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary my-3" type="submit" name="submit" value="Submit">
                </div>

                <?php if(isset($error)) { ?>
                    <div class="form-group">
                        <div class="text-danger"><?php echo $error ?></div>
                    </div>
                <?php } ?>

            </form>
        </div>
    </div>
</body>
</html>

