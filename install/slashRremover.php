<?php

exit;

// This file should be used only before update

$root = dirname( dirname( __FILE__ ) );
$possible_ext = array( 'php', 'txt', 'css', 'js', 'html', 'htm' );

function fileExt($filename){
    if( FALSE == strpos($filename, '.') ){
        return '';
    }
    $e = explode(".", $filename);
    $e = $e[ count($e) - 1 ];
    return $e;
}

function checkSlashRN( $dir ){
    global $possible_ext;
    echo "<ul>";
    $d = dir($dir);
    //echo "Path: " . $d->path . "\n";
    while (false !== ($entry = $d->read())) {
        if( '..' == $entry ) continue;
        if( '.' == substr($entry, 0, 1) ) continue;

        if( is_dir( $dir.'/'.$entry ) ){
            echo "<li>DIR $entry";
            checkSlashRN( $dir.'/'.$entry );
            echo "</li>";
        }else{
            if ( in_array( fileExt($entry), $possible_ext) ) {
                echo "<li>";
                $c = file_get_contents($dir.'/'.$entry);
                if( FALSE === strpos($c,"\r") ){
                    echo '<span style="color:Silver">'.$entry.'</span>';
                }else{
                    $c = str_replace("\r","",$c);
                    file_put_contents($dir.'/'.$entry, $c);
                    echo $entry;
                }
                echo "</li>";
            }else{
                /*
                echo "<li>";
                echo '<span style="color:Silver">'.$entry.'</span>';
                echo "</li>";
                //*/
            }
        }
    }
    $d->close();
    echo "</ul>";
}

checkSlashRN($root);