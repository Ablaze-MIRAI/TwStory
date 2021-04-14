<?php
class test{
    static function now(){
        return date("YmdHis");
    }
}

echo test::now;