<script language="php">
    include("setup.php");
</script>
<script language="php">
    login('deny', 'advertiser');
</script>
<script language="php">
    include("header.php");
</script>
<?php
$api = "YOUR API HERE"; // DOMAIN API
/* iframe height and width */
$width = "800";
$height = "1200";
?>


<table width="600" border="4" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="top" align="left">
            <p>&nbsp;</p>
            <p align="center"><b>
                    <font color="#03F606">ClixWall - Complete Offers and Get Paid.
                </b></p>
            <hr align="center" color="#03F606" size="1">
            <div align="center"><br>
                <br>
                <font color="#03F606">

                    <div align="center"><iframe src="https://www.clixwall.com/wall?api=<?php echo $api; ?>&user=<?php user('username'); ?>" style="height:<?php echo $height; ?>px; width:<?php echo $width; ?>px" frameborder="0" SCROLLING="no"></iframe></div>



                    <br>
            </div>
        </td>
    </tr>
</table>
<script language="php">
    include("footer.php");
</script>



































<script language="php">
    include("footer.php");
</script>
