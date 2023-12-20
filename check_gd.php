<?php
if (extension_loaded('gd') && function_exists('gd_info')) {
    echo "GD library is enabled.";
} else {
    echo "GD library is not enabled.";
}
?>
