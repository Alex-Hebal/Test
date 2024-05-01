<?php
    function test($ausgabe){
        if(TESTMODUS > 0){
            echo('<pre class="test">');
            print_r($ausgabe);
            echo('</pre>');
        }
    }
?>