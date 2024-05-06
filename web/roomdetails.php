<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROOM DETAILS</title>
    <link rel="stylesheet" href="../css/roomdetails.css">
</head>
<body>
    <?php 
        include_once '../PHP/conn.php';
        $sql = "select * from tenant where tn_name = '".$_SESSION['loggedUsername']."'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)){
            $info = mysqli_fetch_array($result);
        }
        else{
            die("Valid user not found!");
        }
    ?>

<header class="head" id="head">

<!-- logo -->
<div class="logo_box">
    <p>MRP</p>
</div>

<!-- Top navigation -->
<div class="nav_box">
    <a href="home.html"><span class="home_page">HOME</span></a>
    <span class="rent_house">RENT</span>
    <a href="landlord.php"><span class="houser">LANDLORD</span></a>
</div>

<!-- Head Portrait -->
<?php   
    if(isset($_SESSION['loggedUsername']) && $_SESSION['loggedUsername'] <> ''){ //
?>
<div class="photo">
    <a href="myprofile.php"><img src="<?php echo $info['tn_photo'] ?>" alt="some_text" width="50" height="50" style="border-radius: 50%;margin-top: 25px;margin-left: 122px;"></a>     
</div>
<?php
    }
    else{
?>  
<div class="photo">
    <a href="myprofile.php"><img src="../web/coverage/photo.png" alt="some_text" width="50" height="50" style="border-radius: 50%;margin-top: 25px;margin-left: 250px;"></a>     
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


    <section>
        <div>
            <img src="../web/coverage/roomdetails1.jpg" style="width: 650px;height: 450px;margin-top: 50px;margin-left: 60px;">
        </div>
    </section>

    <!-- INTRODUCTION -->
    <section>
        <form action="../PHP/confirm_rent.php" method="post">
        <div class="introduce_box">
            <div class="big_title">
                <p class="house_title">幸福花园的二居室</p>
                <p class="price">¥1500/MON</p>
            </div>
            <hr style="border: none;background-color:#BBBBBB; width: 80%;margin-top: 20px;margin-left:0px;height: 1px;">
            
            <div class="small_title">
                <div class="type_box">
                    <span class="type1">FLAT</span>
                    <span class="type2">TYPE</span>
                </div>
                <div class="unit_box">
                    <span class="unit1">2R1L</span>
                    <span class="unit2">ROOM TYPE</span>
                </div>
                <div class="area_box">
                    <span class="area1">65m²</span>
                    <span class="area2">AREA</span>
                </div>
            </div>
            <hr style="border: none;background-color:#BBBBBB; width: 80%;margin-top: 30px;margin-left:0px;height: 1px;">

            <div class="position_box">
                <span class="position_title">LOCATION</span>
                <span class="position">广东省惠州市惠城区河南岸演达大道金山湖路34号</span>  
            </div>
            <hr style="border: none;background-color:#BBBBBB; width: 80%;margin-top: 30px;margin-left:0px;height: 1px;">
        
            <div class="style_box">
                <span class="style_title">DECOR</span>
                <span class="style">INS</span>   
            </div>
            <hr style="border: none;background-color:#BBBBBB; width: 80%;margin-top: 30px;margin-left:0px;height: 1px;">

            <div class="contact_box">
                <?php
                $sql = "select landlord_id from landlord where ll_photo = '../data/images/22220001.png'";
                $result = mysqli_query($conn, $sql);
                $info = mysqli_fetch_array($result);
                ?>
                <img src="../data/images/22220001.png" alt="some_text" width="60" height="60" style="border-radius: 50%; margin-top: 20px; margin-left: 20px;">
                <span class="houser_id">Landlord：<?php echo $info['landlord_id'] ?></span>
                <div class="contact_button">
                    <input type="submit" name="contact"  value="Let the house" style="border: 0;background-color: #826D6D; color: white;font-size: 13px; width: 260px;height: 30px;">
                </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="detail_box">
            <p class="detail_title">ROOM DETAILS</p>
            <p class="detail">　　该房源共有12栋楼。配有24小时安保。该小区有1个出入口，人车均通过此门进出。小区里有健身广场，饮水站，快递柜，花园，生活氛围浓厚。楼下的健身广场，开放给小区居民使用。楼栋概况：小区建成于2008年，楼龄较新。房源所在楼栋共有7层。楼道内比较干净整洁，日常有专人负责清理打扫。单元口配备了门禁，提升了安全性。房源概况 房源位于第1层，在窗边可欣赏小区花园景色，增添一份推窗见景的小美好。房源整体朝南。厨房有阳台，方便储物。厨房里配备了国内外一线品牌的烟机灶具。卫生间配置齐全。南北通透，空气能有效流通。该房源有2间卧室，照顾到不同家庭成员的需求，打造舒适的居住空间。</p>
        </div>
    </section>
        </form>
</body>

</html>