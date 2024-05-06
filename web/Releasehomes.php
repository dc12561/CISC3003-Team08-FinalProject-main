<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RELEASE HOME</title>
    <link rel="stylesheet" href="../css/releasehomes.css">
</head>
<body>
    <?php 
        include_once '../PHP/conn.php';
        $sql = "select * from landlord where ll_name = '".$_SESSION['loggedUsername']."'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)){
            $info = mysqli_fetch_array($result);
        }
        else{
            die("Valid user not found!");
        }
    ?>

    <header class="head" id="head">

        <div class="logo_box">
            <p>MRP</p>
        </div>

        <div class="nav_box">
            <a href="lo_home.html"><span class="home_page">HOME</span></a>
            <a href="lo_rent.php"><span class="rent_house">RENT</span></a>
            <span class="houser">LANDLORD</span>
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
            <a href="lo_myprofile.php"><img src="photo.png" alt="some_text" width="50" height="50" style="border-radius: 50%;margin-top: 25px;margin-left: 250px;"></a>     
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

    <!-- title -->
    <section class="release">
        <p class="release_text">Release of vacant homes</p>
    </section>

    <section class="release_box">
    <form action="../PHP/lo_house.php" method="post">
        <div class="title_box">
            <p class="title_text">TITLE</p>
                <input type="text" name="title" placeholder="title" style="height: 28px; width: 330px;margin-left: 80px;margin-top: 15px;">
        </div>

        <div class="address_box">
            <p class="address_text">LOCATION</p>
                <input type="text" name="address" placeholder="location" style="height: 28px; width: 330px;margin-left: 117px;margin-top: 15px;">
        </div>

        <div class="price_box">
            <p class="price_text">RENT</p>
                <input type="text" name="rent" placeholder="rent" style="height: 28px; width: 130px;margin-left: 117px;margin-top: 15px;">
        </div>

        <div class="region_box">
            <p class="region_text">LOCATION</p>
                <input name="region" type="radio" value="惠城" style="margin-top: 20px;margin-left: 117px;"/><label>惠城区&nbsp;&nbsp;</label>
                <input name="region" type="radio" value="惠阳"/><label>惠阳区&nbsp;&nbsp;</label>
                <input name="region" type="radio" value="惠东"/><label>惠东县&nbsp;&nbsp;</label>
                <input name="region" type="radio" value="博罗"/><label>博罗县&nbsp;&nbsp;</label>
        </div>

        <div class="type_box">
            <p class="type_text">TYPE</p>
                <input name="type" type="radio" value="合租" style="margin-top: 20px;margin-left: 117px;"/><label>JOINT&nbsp;&nbsp;</label>
                <input name="type" type="radio" value="整租"/><label>ENTIRE&nbsp;&nbsp;</label>
                <input name="type" type="radio" value="公寓"/><label>FLAT&nbsp;&nbsp;</label>
                <input name="type" type="radio" value="loft"/><label>LOFT&nbsp;&nbsp;</label>
        </div>


        <div class="unit_box">
            <p class="unit_text">ROOM TYPE</p>
                <input name="unit" type="radio" value="一室一厅" style="margin-top: 20px;margin-left: 117px;"/><label>1R1L&nbsp;&nbsp;</label>
                <input name="unit" type="radio" value="两室一厅"/><label>2R1L&nbsp;&nbsp;</label>
                <input name="unit" type="radio" value="三室两厅"/><label>3R2L&nbsp;&nbsp;</label>
                <input name="unit" type="radio" value="四室两厅"/><label>4R2L&nbsp;&nbsp;</label>
        </div>

        <div class="area_box">
            <p class="area_text">AREA</p>
                <input name="area" type="radio" value="50以下" style="margin-top: 20px;margin-left: 117px;"/><label>50m²-&nbsp;&nbsp;</label>
                <input name="area" type="radio" value="50-80"/><label>50~80m²&nbsp;&nbsp;</label>
                <input name="area" type="radio" value="80-100"/><label>80~100m²&nbsp;&nbsp;</label>
                <input name="area" type="radio" value="100以上"/><label>100m²+&nbsp;&nbsp;</label>
        </div>

        <div class="style_box">
            <p class="style_text">DECOR</p>
                <!-- <input checked type="radio" name="style" value="style1" /><label>不限&nbsp;&nbsp;</label> -->
                <input name="style" type="radio" value="精装修" style="margin-top: 20px;margin-left: 80px;"/><label>REFINED&nbsp;&nbsp;</label>
                <input name="style" type="radio" value="粗装修"/><label>ROUGH&nbsp;&nbsp;</label>
                <input name="style" type="radio" value="ins风格"/><label>INS&nbsp;&nbsp;</label>
                <input name="style" type="radio" value="复古风格"/><label>TRADITIONAL&nbsp;&nbsp;</label>
                <input name="style" type="radio" value="温馨风格"/><label>WARM&nbsp;&nbsp;</label>
        </div>

        <div class="detail_box">
            <p class="detail_text">DETAILS</p>
                <textarea rows="10" cols="60" name="detail" placeholder="Please describe your house in detail!" style="margin-left: 80px;margin-top: 15px;"></textarea>
        </div>

        <div class="release_submit">
            <input type="submit" name="release"  value="submit" style="border: 0;background-color: #826D6D; color: white;font-size: 12px; width: 100px;height: 28px;">
        </div>
    </form>
    </section>
    
</body>
</html>