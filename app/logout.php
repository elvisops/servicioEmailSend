<?php
if (!isset($_SESSION)) {
    session_start();
}
session_destroy();
echo 1;
