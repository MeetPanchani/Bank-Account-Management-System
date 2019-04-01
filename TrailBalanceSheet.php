<?php
include_once 'DBConnection.php';
$totalcr=0;
$totaldr=0;
$cbalancecr=0;
$cbalancedr=0;
$query="SELECT AccountID,AccountNumber,HolderName1,ClosingBalance FROM AccountMaster";
$result=mysqli_query($link,$query);
 ?>
<html>
<head>
  <title>Trail Balance Sheet</title>
</head>
<body>
  <table align="center" width="800px" >
    <tr>
      <td colspan="5">
        <?php include 'Header.html';?>
      </td>
    </tr>
    <tr>
          <td valign="top">
            <?php
              include_once 'Menu.php';
            ?>
          </td>
          <td style="width:699px">
            <table width="699px" >
              <tr>
              <th colspan="4">
                <b>Trial Balance Sheet</b>
              </th>
              </tr>
              <tr>
                <td>
                  <b>Accoun Number</b>
                </td>
                <td>
                  <b>Name</b>
                </td>
                <td align="right">
                  <b>Balance Cr</b>
               </td>
               <td align="right">
                 <b>Balance Dr</b>
              </td>
              </tr>
              <tr>
                <td><hr /></td>
                <td><hr /></td>
                <td><hr /></td>
                <td><hr /></td>
              </tr>
              <?php
              while($row=mysqli_fetch_assoc($result))
              {
               ?>
               <tr>
                 <td>
                   <?php echo $row['AccountNumber'];?>
                 </td>
                 <td>
                   <?php echo $row['HolderName1'];?>
                 </td>
                 <?php
                 $cbalance=$row['ClosingBalance'];
                if($cbalance>0)
                {
                  $cbalancecr=$cbalance;
                }
                else
                {
                  $cbalancedr=abs($cbalance);

                }

                 $totalcr=$totalcr+$cbalancecr;
                 $totaldr=$totaldr+$cbalancedr;

                 ?>

                 <td align="right">
                <?php
                echo $cbalancecr;

                ?>
                 </td>
                 <td align="right">
                <?php
                echo $cbalancedr;
                $cbalancedr=0;
                $cbalancecr=0;
                ?>
                 </td>

               </tr>
             <?php } ?>
             <tr>
               <td><hr /></td>
               <td><hr /></td>
               <td><hr /></td>
               <td><hr /></td>
             </tr>
             <tr>
               <td>
                 <b>Total</b>
               </td>
               <td>
                 &nbsp;
               </td>
               <td align="right">
                 <?php echo $totalcr;?>
               </td>
               <td align="right">
                 <?php echo $totaldr;?>
               </td>
             </tr>
            </table>
          </td>
    </tr>
    <tr>
      <td colspan="7">
        <?php include 'Footer.html';?>
      </td>
    </tr>
  </table>
</body>
</html>
