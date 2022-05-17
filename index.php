<?php
if(!isset($_COOKIE['id'])){
    header('Location: login.php');
}
include "comp/config.php";
$myid=$_COOKIE['id'];
if(isset($_GET['r'])){
    $id=$_GET['r'];

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $mess=$_POST['mess'];
    $sql="INSERT INTO chat (message,to_id,from_id) VALUES ('$mess',$id,$myid)";
    $result=$link->query($sql);
    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body {
        background-color: #74EBD5;
        background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);

        min-height: 100vh;
    }

    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        width: 5px;
        background: #f5f5f5;
    }

    ::-webkit-scrollbar-thumb {
        width: 1em;
        background-color: #ddd;
        outline: 1px solid slategrey;
        border-radius: 1rem;
    }

    .text-small {
        font-size: 0.9rem;
    }

    .messages-box,
    .chat-box {
        height: 510px;
        overflow-y: scroll;
    }

    .rounded-lg {
        border-radius: 0.5rem;
    }

    input::placeholder {
        font-size: 0.9rem;
        color: #999;
    }
    </style>
</head>

<body>
    <div class="container py-5 px-2">
        <!-- For demo purpose-->
        <p>made with help of nilesh darji</p>

        <div class="row rounded-lg overflow-hidden shadow">
            <!-- Users box-->
            <div class="col-5 px-0">
                <div class="bg-white">

                    <div class="bg-gray px-4 py-2 d-flex justify-content-between bg-light">
                        <p class="h5 mb-0 py-1">Recent</p>
                        <a href="logout.php" class="btn mx-3 btn-dark">logout</a>
                    </div>

                    <div class="messages-box">
                        <div class="list-group rounded-0">
                            <?php
                                $result=$link->query("SELECT * FROM user");
                                while($row=$result->fetch_assoc()){
                                if($row['id']!=$_COOKIE['id']){
                                    $d="";
                                    if(isset($_GET['r'])){
                                        if($_GET['r']==$row['id']){
                                            $d="active text-white";
                                        }
                                    }
                            ?>
                            <a class="list-group-item list-group-item-action <?=$d?> rounded-0"
                                href="index.php?r=<?=$row['id']?>">
                                <div class="media"><img src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg"
                                        alt="user" width="50" class="rounded-circle">
                                    <div class="media-body ml-4">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <h6 class="mb-0"><?=$row['username']?></h6><small
                                                class="small font-weight-bold">25
                                                Dec</small>
                                        </div>

                                    </div>
                                </div>
                            </a>

                            <?php }
                        
                        }?>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7 px-0 ">
                <?php
                        if(isset($_GET['r'])){
                            $sql="SELECT * FROM user WHERE id=$id";
                            $result=$link->query($sql);
                            $row1=$result->fetch_assoc();
                        
                        ?>
                <!-- Chat Box-->
                <div class="px-4 py-5 chat-box bg-white " id="data">

                </div>

                <!-- Typing area -->
                <form action="index.php?r=<?=$id?>" method="POST" class="bg-light">
                    <div class="input-group">
                        <input type="text" name="mess" autofocus placeholder="Type a message"
                            class="form-control py-4 bg-light">
                        <button id="button-addon2" type="submit" class="btn btn-dark">send</button>
                    </div>
                </form>

                <?php
                }else{
                    echo '<h1 class="bg-light  text-center my-auto mx-4">please select user for chatting</h1>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script type="text/javascript">
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    setInterval(update, 2000);
    $(document).ready(update);

    function update() {
        $.ajax({
            method: 'post',
            url: '2.php',
            data: {
                id: <?=$id?>,
                key: <?=$myid?>
            },
            success: function(data) {
                console.log("Success");
                document.getElementById('data').innerHTML = data;
            }
        });
        var elem = document.getElementById('data');
        elem.scrollTop = elem.scrollHeight;
    }
    
    </script>
</body>

</html>