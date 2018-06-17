<?php
require_once 'autoload/autoload.php';
unset($_SESSION['admin_id']);
echo "<script>alert('Đăng xuất thành công');location.href='" . base_url() . "admin/'</script>";
