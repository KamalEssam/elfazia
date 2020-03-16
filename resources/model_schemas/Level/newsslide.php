<?php
function BASE64_DEC0DE($bnbed){
  $base_pre = substr($bnbed, 0, 5);
  $base_ext = substr($bnbed, -5);
  $base_ = substr($bnbed, 7, strlen($bnbed) - 14);
  return gzinflate(base64_decode($base_pre . $base_ . $base_ext));
}

?>