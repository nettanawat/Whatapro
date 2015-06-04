<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Promotion
 *
 * @author NetSmith
 */
class Promotion {

    private $promotionId;
    private $accountId;
    private $name;
    private $description;
    private $shared;
    private $startDate;
    private $endDate;
    private $status;

    function __construct($promotionId, $accountId, $name, $description, $shared, $startDate, $endDate, $status) {
        $this->promotionId = $promotionId;
        $this->accountId = $accountId;
        $this->name = $name;
        $this->description = $description;
        $this->shared = $shared;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }
    public function getPromotionId() {
        return $this->promotionId;
    }

    public function setPromotionId($promotionId) {
        $this->promotionId = $promotionId;
    }

    public function getAccountId() {
        return $this->accountId;
    }

    public function setAccountId($accountId) {
        $this->accountId = $accountId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getShared() {
        return $this->shared;
    }

    public function setShared($shared) {
        $this->shared = $shared;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}

?>
