<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function CloseToTarget($target_date){ 
    
    $now = new DateTime(); 
    $diff = abs(strtotime($target_date) - strtotime($now));
    return $diff; 
    echo $now; 
    
   }