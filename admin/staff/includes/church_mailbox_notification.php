<?php
include 'connect.php';
$notif = "UPDATE mailbox SET message_status='read' WHERE message_status='unread'";
$query = mysqli_query($conn, $notif);