<?php
/**
 * Created by PhpStorm.
 * User: nettanwat
 * Date: 11/12/15 AD
 * Time: 3:25 PM
 */

interface PointDAO {
    public function addReceivePoint(PointInfo $pointInfo);
    public function addSpendPoint(PointInfo $pointInfo);
    public function getLastPointById($id);

} 