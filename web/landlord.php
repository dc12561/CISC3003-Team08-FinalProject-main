<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LANDLORD</title>
    <link rel="stylesheet" href="../css/landlord.css">
</head>
<body>
    <?php 
        include_once '../PHP/conn.php';
        $sql = "select * from landlord where ll_name = '".$_SESSION['loggedUsername']."'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)){
            $info = mysqli_fetch_array($result);

            $search = "SELECT tenant.tn_name, tenant.tn_phonenum, wanthouse.* FROM tenant,wanthouse WHERE tenant.tenant_id = wanthouse.tenant_id ORDER BY region desc";
            $res = mysqli_query($conn, $search);

            $house = "SELECT house.house_id, house.house_name from house,landlord where landlord.ll_name = '".$_SESSION['loggedUsername']."' AND landlord.landlord_id = house.landlord_id";
            $hou = mysqli_query($conn, $house);
        }
        else{
            die("Valid user not found! Please log in with your tenant account.");
        }
    ?>

    <header class="head" id="head">

        <!-- logo -->
        <div class="logo_box">
            <p>MRP</p>
        </div>

        <div class="nav_box">
            <a href="home.html"><span class="home_page">HOME</span></a>
            <a href="rent.php"><span class="rent_house">RENT</span></a>
            <span class="houser">LANDLORD</span>
        </div>


        <?php   
            if(isset($_SESSION['loggedUsername']) && $_SESSION['loggedUsername'] <> ''){ 
        ?>
        <div class="photo">
            <a href="lo_myprofile.php"><img src="<?php echo $info['ll_photo'] ?>" alt="some_text" width="50" height="50" style="border-radius: 50%;margin-top: 25px;margin-left: 122px;"></a>     
        </div>
        <?php
            }
            else{
        ?>  
        <div class="photo">
            <a href="lo_myprofile.php"><img src="../web/coverage/photo.png" alt="some_text" width="50" height="50" style="border-radius: 50%;margin-top: 25px;margin-left: 250px;"></a>     
        </div>
        <?php
            }
        ?>
    </header>

    <!--search-->
    <form action="" class="search_box">
        <input class="search" type="text" name="search" id="searchBox" placeholder=" Please enter your search">
        <input type="button" name="submit" id="searchButton" value="search" style="border: none;background-color: rgba(217, 179, 163, 86);opacity: 0.79;">
        <script>
            var searchEle = document.getElementById("searchBox");
            var c = searchEle.placeholder;
            searchEle.onfocus = function () {
                if (searchEle.placeholder === c){
                    searchEle.placeholder = ""
                }
            };
            searchEle.onblur = function () {
                if (!searchEle.placeholder.trim()){
                    searchEle.placeholder = c;
                }
            };
        </script>
    </form>

    <!-- MY ROOM -->
    <section>
        <div class="check_title">
            <p class="title1">Check my room</p>
        </div>

        <div class="check_box">
            <table border="1rpx" align="center" cellpadding="8" cellspacing="0" width="750px" height="150px" bordercolor="#BBBBBB">
                <tr align="center" height="60px" bgcolor="#A29F9F">
                    <th>HOUSE NUMBER</th>
                    <th>HOUSE NAME</th>
                    <th>HOUSE STATE</th>
                    <th>CHANGE INFROMATION</th>
                </tr>

                <?php
                while($ord = mysqli_fetch_array($hou)){    ?>
                <tr align="center">
                <td><?php echo $ord['house_id']?></td>
                <td><?php echo $ord['house_name']?></td>
                <td>
                    <?php 
                        $house_id = $ord['house_id'];
                        $is_rent = "SELECT orders.* from orders,house where orders.house_id = $house_id";
                        $res1 = mysqli_query($conn, $is_rent);

                        if(mysqli_num_rows($res1)==0){
                            echo 'Not rented';
                        }
                        else echo 'Rented';
                    ?>
                </td>
                <td><a href="Releasehomes.php">Modifying house information</a></td>
                </tr>
                <?php
                    }
                ?>
        </div>
    </section
    <!-- My push service -->
    

        <div class="send_box">
            <table border="1rpx" align="center" cellpadding="8" cellspacing="0" width="750px" height="250px" bordercolor="#BBBBBB">
                <tr align="center" height="60px" bgcolor="#A29F9F">
                    <th>Tenantname</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Decor</th>
                    <th>Connect with tenants</th>
                </tr>
                <?php
                while($ord = mysqli_fetch_array($res)){?>
            <tr align="center">
                <td><?php echo $ord['tn_name']?></td>
                <td><?php echo $ord['region']?></td>
                <td><?php echo $ord['renthouse_type']?></td>
                <td><?php echo $ord['decoration']?></td>
                <td><?php echo $ord['tn_phonenum']?></td>
            </tr>
            <?php
                }
            ?>
            </table>
        </div>

    <section>
        <div class="send_title">
            <p class="title2">My push service</p>
        </div>
    </section>
    


    <section>
        <div class="add_box">
            <a href="Releasehomes.php"><img src="../web/coverage/add.png" alt="some_text" width="100" height="100" style="margin-top: 20px;"></a>
            <p class="add_text">Release vacant romes</p>
        </div>
        
    </section>
    
</body>

</html>