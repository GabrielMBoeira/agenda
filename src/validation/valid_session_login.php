<?php

if (!$_SESSION['valid-login']) {
    header('Location: login');
}