<?php if (!defined('THINK_PATH')) exit();?><html>
  <head>
    <title>redirect......</title>
    <meta http-equiv="content-Type" content="text/html; charset=gb2312" />
  </head>
  <body>
    <form action="<?php echo ($form_url); ?>"  method="post" id="frm1">
      <input type="hidden" name="Mer_code" value="<?php echo ($Mer_code); ?>">
      <input type="hidden" name="Billno" value="<?php echo ($Billno); ?>">
      <input type="hidden" name="Amount" value="<?php echo ($Amount); ?>">
      <input type="hidden" name="Date" value="<?php echo ($Date); ?>">
      <input type="hidden" name="Currency_Type" value="<?php echo ($Currency_Type); ?>">
      <input type="hidden" name="Gateway_Type" value="<?php echo ($Gateway_Type); ?>">
      <input type="hidden" name="Lang" value="<?php echo ($Lang); ?>">
      <input type="hidden" name="Merchanturl" value="<?php echo ($Merchanturl); ?>">
      <input type="hidden" name="FailUrl" value="<?php echo ($FailUrl); ?>">
      <input type="hidden" name="ErrorUrl" value="<?php echo ($ErrorUrl); ?>">
      <input type="hidden" name="Attach" value="<?php echo ($Attach); ?>">
      <input type="hidden" name="DispAmount" value="<?php echo ($DispAmount); ?>">
      <input type="hidden" name="OrderEncodeType" value="<?php echo ($OrderEncodeType); ?>">
      <input type="hidden" name="RetEncodeType" value="<?php echo ($RetEncodeType); ?>">
      <input type="hidden" name="Rettype" value="<?php echo ($Rettype); ?>">
      <input type="hidden" name="ServerUrl" value="<?php echo ($ServerUrl); ?>">
      <input type="hidden" name="SignMD5" value="<?php echo ($SignMD5); ?>">
    </form>

    <script language="javascript">
      document.getElementById("frm1").submit();
    </script>
  </body>
</html>