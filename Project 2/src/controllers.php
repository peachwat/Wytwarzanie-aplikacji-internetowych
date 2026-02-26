<?php
require_once 'business.php';
require_once 'controller_functions.php';

function index(&$model)
{
    if (isset($_SESSION['user_id'])) {
        $user = get_user_by_id($_SESSION['user_id']);
        if ($user) {
            $model['message'] = "Hello, {$user['login']}! You logged in successfully.";
        }
    }
    return 'index_view';
}

function gallery(&$model)
{
    $picture = [
        'watermark' => null,
        'fileName'  => null,
        'title'=> null,
        'private' => null,
        'user_id' => null,
        'author'=> null
    ];
    $correctsize=null;
    $correctformat=null;
    
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
        $picture = [
            'watermark' => $_POST['watermark'],
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'private' => $_POST['private'] ?? 'public',
            'user_id'=> $_SESSION['user_id'] ?? null,
            'fileName'  => $_FILES['fileToUpload']['name']
        ];
        //$finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_name = $_FILES['fileToUpload']['tmp_name'];
        $file_size=$_FILES['fileToUpload']['size'];
        //$mime_type = finfo_file($finfo, $file_name);
        $mime_type = $_FILES['fileToUpload']['type'];

        if($mime_type==='image/jpeg'|| $mime_type ==='image/png')
        {
            $correctformat=true;
        }
        else
        {
            $correctformat=false;
        }

        if($file_size > (1024*1024) )
        {
            $correctsize=false;
        }
        else
        {
            $correctsize=true;
        }

        
        $visibility = $_POST['private'] ?? 'public'; 

        
        $picture['private'] = ($visibility === 'private');


        if ($correctformat && $correctsize) {
            //$upload_dir = $_SERVER["DOCUMENT_ROOT"].'/images/1/';
            $upload_dir = $_SERVER["DOCUMENT_ROOT"].'/images/1/';
            $file = $_FILES['fileToUpload'];
            $file_name = basename($file['name']);
            $target = $upload_dir . $file_name;
            $tmp_path = $file['tmp_name'];
            var_dump($file);
            //echo $target;
            
            if(move_uploaded_file($tmp_path, $target))
            {
                create_watermark($picture, $mime_type);
                create_mini($picture, $mime_type);
                save_picture($picture['watermark'], $picture['author'], $picture['title'], $picture['private'], $picture['fileName'], $picture['user_id']);
                return 'redirect:gallery';
            } else echo "failed to upload";
        } else echo "incorrect format or size";
    } 

    $model['picture'] = $picture;
    $model['correctformat'] = $correctformat;
    $model['correctsize'] = $correctsize;

    if (isset($_SESSION['user_id'])) {
        $user = get_user_by_id($_SESSION['user_id']);
        if ($user) {
            $model['picture']['author'] = $user['login'];
        }
    }
    return 'gallery_view';
}

function gallery2(&$model)
{
    return 'gallery2_view';
}

function pictures(&$model)
{
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    $pictures = get_pictures($page);
    $model['pictures'] = $pictures;

    $picturesNumber = get_pictures_number();

    $pagesNumber = ceil($picturesNumber / 3);

    $model['pagesNumber'] = $pagesNumber;
    $model['picturesNumber'] = $picturesNumber;
    $model['page'] = $page;
    return 'gallery2_view';
}

function signup(&$model)
{
    $model['passwordMatchError'] = false;
    $model['loginTakenError'] = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["signup"])) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordconfirm = $_POST['passwordconfirmation'];

        if ($password !== $passwordconfirm) {
            $model['passwordMatchError'] = true;
        } else {
            $user = get_user_by_login($login);
            if ($user !== null) {
                $model['loginTakenError'] = true;
            } else {
                create_user($login, $email, $password);
                header('Location: /index');
                exit;
            }
        }
    }

    return 'signup_view';
}

function signin(&$model)
{
    $model['loginError'] = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signin'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $user = authenticate($login, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['_id']; 
            header('Location: /index');
            exit;
        } else {
            $model['loginError'] = true;
            return 'signin_view';
        }
    }

    return 'signin_view';
}

function logout(&$model)
{
    return 'logout';
}


?>