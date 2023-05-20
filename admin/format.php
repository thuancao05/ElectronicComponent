<?php
    function format_curency($n=0){
       $n=(string)$n;
       $n=strrev($n);
       $res='';
       for($i=0; $i<strlen($n); $i++){
        if($i%3 == 0 && $i != 0){
            $res.='.';
        }
        $res.=$n[$i];
        
       } 
       $res=strrev($res);
       return $res;
    }
?>