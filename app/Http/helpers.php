<?php
function setActiveRout($name){
    return request()->routeIs($name) ? 'active' : '';
}

?>
