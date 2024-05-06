<?php
    session_start();
    include_once '../PHP/conn.php';

    // 获取当前登录租户的ID
    $tenant_id_query = "SELECT tenant_id FROM tenant WHERE tn_name = '".$_SESSION['loggedUsername']."'";
    $tenant_id_result = mysqli_query($conn, $tenant_id_query);
    if ($tenant_id_row = mysqli_fetch_assoc($tenant_id_result)) {
        $tenant_id = $tenant_id_row['tenant_id'];
    } else {
        echo '<h1>My Orders - Tenant</h1>';
        echo '<p>No tenant record found for the logged user.</p>';
        exit;
    }

    // 创建新的订单
    $insert_sql = "INSERT INTO deal (landlord_id, tenant_id, admin_id, house_id, status_id, payment_status) VALUES (22220001, $tenant_id, 10100001, 11110001, 1, 1)";

    $insert_result = mysqli_query($conn, $insert_sql);

    if (!$insert_result) {
        echo '<p>Failed to create order.</p>';
        exit;
    }

    // 显示更新后的订单信息
    $sql = "SELECT d.deal_id, d.house_id, ts.description AS status_description, ps.description AS payment_status, d.transaction_certificate
            FROM deal d
            JOIN Transaction_Status ts ON d.status_id = ts.status_id
            JOIN Payment_Status ps ON d.payment_status = ps.status_id
            WHERE d.tenant_id = $tenant_id";

    $result = mysqli_query($conn, $sql);

    echo '<h1>My Orders - Tenant</h1>';
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="order">';
            echo '<p>Deal ID: ' . $row['deal_id'] . '</p>';
            echo '<p>House ID: ' . $row['house_id'] . '</p>';
            echo '<p>Status: ' . $row['status_description'] . '</p>';
            echo '<p>Payment Status: ' . $row['payment_status'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No orders found.</p>';
    }

    $username = trim($_SESSION['loggedUsername']);
    $title = "幸福花园的二居室";//house_name
    $address = "广东省惠州市惠城区河南岸演达大道金山湖路34号";//address
    $type = "公寓";// renthouse_type
    $unit = "二室一厅";// house_type
    $area = "65";//area
    $style = "ins风格";// decoration
    $region = "惠城";//region
    $rent = 1500;//rent
    $detail = "　　该房源共有12栋楼。配有24小时安保。该小区有1个出入口，人车均通过此门进出。小区里有健身广场，饮水站，快递柜，花园，生活氛围浓厚。楼下的健身广场，开放给小区居民使用。楼栋概况：小区建成于2008年，楼龄较新。房源所在楼栋共有7层。楼道内比较干净整洁，日常有专人负责清理打扫。单元口配备了门禁，提升了安全性。房源概况 房源位于第1层，在窗边可欣赏小区花园景色，增添一份推窗见景的小美好。房源整体朝南。厨房有阳台，方便储物。厨房里配备了国内外一线品牌的烟机灶具。卫生间配置齐全。南北通透，空气能有效流通。该房源有2间卧室，照顾到不同家庭成员的需求，打造舒适的居住空间。";//detail

    include_once "conn.php";
   
    $insert_deal = "INSERT into deal set landlord_id = 22220001,tenant_id = ( select tenant_id from tenant where tn_name = '$username'),admin_id = 10100001, house_id=(select house_id from house where house_name = '$title' and area = $area)";
    
    $result = mysqli_query($conn,$insert_deal);
  
    $sql = "INSERT into orders set landlord_id = 22220001,
    tenant_id =( select tenant_id from tenant where tn_name = '$username'), 
    house_id=(select house_id from house where house_name = '$title' and area = $area)";
    $result = mysqli_query($conn,$sql);
    $url = '../web/roomdetails.php'

?>