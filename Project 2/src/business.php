<?php 

require '../../vendor/autoload.php';
use MongoDB\BSON\ObjectID;

function get_db()
{
    $mongo = new MongoDB\Client(
        'mongodb://localhost:27017/wai',
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b'
        ]
    );

    $db = $mongo->wai;
    return $db;
}

function save_picture($watermark, $author, $title, $private, $fileName, $user_id)
{
    $db = get_db();

    $picture = [
        'watermark' => $watermark,
        'author' => $author,
        'title' => $title,
        'private' => $private,
        'fileName' => $fileName,
        'user_id' => $user_id, // Используем логин пользователя как user_id
    ];

    $db->pictures->insertOne($picture);
}


function create_user($login, $email, $password){
    $db = get_db();
    $user = [
        'login' => $login,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ];
    $db->users->insertOne($user);
}

function get_user_by_login($login){
    $query = [
        'login' => $login
    ];
    $db = get_db();
    $user = $db->users->findOne($query);
    return $user;
}

function authenticate($login, $password){
    $user = get_user_by_login($login);
    if ($user != null && password_verify($password, $user['password']))
        return $user;
    return false;
}

function get_user_by_id($id){
    $db = get_db();

    return $db->users->findOne(['_id' => new ObjectID($id)]);
}

function get_pictures($page)
{
    $db = get_db();
    $pageSize = 3;
    $opts = [
        'skip' => ($page - 1) * $pageSize,
        'limit' => $pageSize
    ];

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        
        $query = [
            '$or' => [
                ['private' => false], 
                [
                    '$and' => [ 
                        ['private' => true],
                        ['user_id' => $user_id]
                    ]
                ]
            ]
        ];
    } else {
        $query = ['private' => false];
    }

    $pictures = $db->pictures->find($query, $opts)->toArray();
    return $pictures;
}

function get_pictures_number()
{
    $db = get_db();
    
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $picturesNumber = count($db->pictures->find(['$or' => [['private' => false], ['user_id' => $user_id]]])->toArray());
    } else {
        $picturesNumber = count($db->pictures->find(['private' => false])->toArray());
    }
    return $picturesNumber;
}

?>