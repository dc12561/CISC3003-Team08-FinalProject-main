<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY ORDER</title>
</head>
<body>
    
</body>
    <?php 
        include_once '../PHP/conn.php';
        $sql = "select * from landlord where ll_name = '".$_SESSION['loggedUsername']."'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)){
            $info = mysqli_fetch_array($result);
            $search = "SELECT house.house_name, orders.*,house.rent FROM landlord,house,orders
            where orders.landlord_id = landlord.landlord_id and landlord.ll_name = '".$_SESSION['loggedUsername']."' and house.house_id = orders.house_id";
            $res = mysqli_query($conn, $search);
        }
        else{
            die("Valid user not fouSnd!");
        }
    ?>

    <header class="head" id="head">

        <!-- logo -->
        <div class="logo_box">
            <a href="lo_rent.php" style="color: white;"><p>MRP</p></a>
        </div>

        <div class="nav_box">
            <a href="lo_myprofile.php"><span class="message_title">MY PROFILE</span></a>
            <span class="oder_title">MY ORDER</span>
            <a href="landlord.php"><span class="houser">LANDLORD</span></a>
        </div>

        <?php   
            if(isset($_SESSION['loggedUsername']) && $_SESSION['loggedUsername'] <> ''){ //
        ?>
        <div class="photo">
            <a href="lo_myprofile.php"><img src="<?php echo $info['ll_photo'] ?>" alt="some_text" width="50" height="50" style="border-radius: 50%;margin-top: 25px;margin-left: 122px;"></a>     
        </div>
        <?php
            }
            else{
        ?>  
        <div class="photo">
            <a href="lo_myprofile.php"><img src="photo.png" alt="some_text" width="50" height="50" style="border-radius: 50%;margin-top: 25px;margin-left: 122px;"></a>     
        </div>
        <?php
            }
        ?>
    </header>

    <section class="mem_box">
        <?php   
            if(isset($_SESSION['loggedUsername']) && $_SESSION['loggedUsername'] <> ''){ 
        ?>
        <div>
            <a href="lo_myprofile.php"><img src= "<?php echo $info['ll_photo'] ?>" alt="用户头像" width="75" height="75" style="border-radius: 50%;margin-top: 15px;"></a>     
        </div>
        <span class="username"><?php echo $_SESSION['loggedUsername'];?></span>
        <?php
            }
            else{
        ?>   
        <div>
            <a href="lo_myprofile.php"><img src="../web/coverage/photo.png" alt="some_text" width="75" height="75" style="border-radius: 50%;margin-top: 15px;"></a>     
        </div>

        <span class="username">USER NAME</span>
        <?php
            }
        ?>

        <div class="mem_text">
            <a href="landlordlogin.html"><span class="switch_account">Switch</span></a>
            <a href="../PHP/logout.php"><span class="logout">Logout</span></a>
        </div> 
    </section>

    <!-- title -->
    <section class="myoder">
        <p class="oder_text">ORDER MANAGE</p>
    </section>

    <section class="oder_box">
        <div class="title">
            <a href="#"><span class="house_title">ROOM ORDER<br><br><br></span></a>
            <div id="Layer1" style="margin-top: -113px;margin-left: 100px;position:absolute; width:1px; height:500px; z-index:1; background-color: #BBBBBB; border: 1px none #BBBBBB;"></div>
        </div>

        <div class="classify_box">
        <table border="1rpx" align="center" cellpadding="8" cellspacing="0" width="640px" height="150px" bordercolor="#BBBBBB">
        <tr align="center" height="60px" bgcolor="#A29F9F">
                <th>ROOM NAME</th>
                <th>ORDER NUMBER</th>
                <th>ORDER TIME</th>
                <th>RENT</th>
                <th>Tripartite agreement</th>
            </tr>
            <?php
                while($ord = mysqli_fetch_array($res)){?>
            <tr align="center">
                <td><?php echo $ord['house_name']?></td>
                <td><?php echo $ord['order_id']?></td>
                <td><?php echo $ord['time']?></td>
                <td><?php echo $ord['rent']?></td>
                <td><img src="<?php echo $ord['photo']?>" width="150px", height="130px"></td>
            </tr>
            <?php
                }
            ?>

        </table>
        </div>
        
    </section>

</html>