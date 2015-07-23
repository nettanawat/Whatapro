<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 7/2/15 AD
 * Time: 2:05 PM
 */
include dirname(__FILE__) . '/../Config.php';

$database = new medoo();
$query = "SELECT * FROM Promotions INNER JOIN ShopInformations ON Promotions.shop_id = ShopInformations.accounts_id WHERE Promotions.id LIKE '%" . $_GET['key'] . "%' OR ShopInformations.name LIKE '%" . $_GET['key'] . "%' OR Promotions.name LIKE '%" . $_GET['key'] . "%' ORDER BY id DESC";
$promotionListTemp = array();
if ($_GET['key'] == " ") {
    $promotionListTemp = PromotionController::getAllPromotion();
} else {
    foreach ($database->query($query)->fetchAll() as $row) {
        $promotionListTemp[] = new Promotion($row['id'], $row['shop_id'], $row['name'], $row['description'], $row['shared'], $row['start_date'], $row['end_date'], $row['status']);
    }

    //some thing wrong, this shit return promotion name instead of shop name kuayyyyyyyy || 2 columns from 2 tables have same name
    $promotionList = array();
    foreach($promotionListTemp as $promotion){
        $promotionList[] = PromotionController::getPromotionById($promotion->getPromotionId());
    }

    foreach($promotionList as $promotion){
        $promotionImageList = array();
        $promotionImageController = new PromotionImageController();
        $imageList = $promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId());
        if($promotionImageController->getPromotionImageByPromotionId($promotion->getPromotionId()) != null){
            foreach($imageList as $image){
                $promotionImageList[] = $image->getImagePath();
            }
        }
        $shopInfo = ShopInformationController::getShopInformationById($promotion->getAccountId());
        Adaptor::setStatus($promotion->getStatus());
        $startDate = new DateTime($promotion->getStartDate());
        $endDate = new DateTime($promotion->getEndDate());
        ;
        echo('<tr class="tableData">
                    <td>'.$promotion->getPromotionId().'</td>
                    <td><a href="'.Config::PATH.'/promotion/'.$promotion->getPromotionId().'">'.$promotion->getName().'</a></td>
                    <td><a href="'.Config::PATH.'/account/'.$shopInfo->getAccountId().'">'.$shopInfo->getName().'</a></td>
                    <td>'.$startDate->format('Y-m-d').'</td>
                    <td>'.$endDate->format('Y-m-d').'</td>
                    <td class="col-md-4">');
        foreach($promotionImageList as $aImage){
            echo'<img class="col-md-3" src="'. Config::PATH."/".$aImage.'">';
        }
        echo ('</td>
                    <td>'.Adaptor::getStatus().'</td>
                    <td>
                            <form id="deleteForm" name=promotion action="" method="post">
                                <input type=hidden value=' . $promotion->getPromotionId() . ' name="promotionId" >
                                <button name="edit" type=submit><span class="glyphicon glyphicon-edit"></span></button>
                                <button onclick="show_alert(); return false;" name="delete" type=submit><span class="glyphicon glyphicon-remove-circle"></span></button>
                            </form>
                        </td>
                </tr>');
    }
}
