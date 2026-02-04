<?php
session_start();
session_destroy();
echo "<script>
        alert('ออกจากระบบเรียบร้อย');
        window.location.href='index.php';
      </script>";
exit();
?>