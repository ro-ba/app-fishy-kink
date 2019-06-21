<?php
    function session_exists(){
        if(session('username')){
            return True;
        }else
            return False;
    }
?>