<?php

// Delete the session cookie
session_start();
session_unset();
session_destroy();