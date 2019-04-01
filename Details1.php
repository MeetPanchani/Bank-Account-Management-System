<?php
include_once 'DBConnection.php';
$acnumber='';
$accountnum='';
$msgnum='';
$msgname='';
$cramount='';
$dramount='';
$msgdate='';
$msgnarration='';
$msgcr='';
$msgdr='';
$name1='';
$msgbalance='';
$obalance='';
$result2=TRUE;
if(isset($_POST['btnSave'])=='Save')
{
  $accountnum=$_POST['acnumber'];
  $query1="SELECT AccountNumber,HolderName1,OpeningBalance,ClosingBalance from AccountMaster WHERE AccountNumber=$accountnum";
  $result1=mysqli_query($link,$query1);
  while($row=mysqli_fetch_array($result1))
  {
    $acnumber=$row['AccountNumber'];
    $name1=$row['HolderName1'];
    $obalance=$row['OpeningBalance'];
    $cbalance=$row['ClosingBalance'];
  }
  $msgnum="Account Number : ";
  $msgname="Account Holder Name : ";

  $query2="SELECT * from Transaction where AccountIDcr=$accountnum or AccountIDdr=$accountnum";
  $result2=mysqli_query($link,$query2);
  $msgdate="<b>Date</b>";
  $msgnarration="<b>Narration</b>";
  $msgcr="<b>CR</b>";
  $msgdr="<b>DR</b>";
  $msgbalance="<b>Balance</b>";
}
 ?>
<html>
<head>
  <title>Details</title>
</head>
<body>
  <table width="800px" align="center">
    <tr>
      <td colspan="2">
        <?php include 'Header.html';?>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <?php
        include 'Menu.php';
         ?>
      </td>
      <td align="left">
        <form method="post" enctype="multipart/form-data" action="Details.php">
          <table align="center">
            <tr>
              <th colspan="2">
                <b>Show Ledger</b>
              </th>
            </tr>
            <tr>
              <td>
                Account Number
              </td>
              <td>
                <input type="text" name="acnumber" value="<?php echo $acnumber;?>" />
                <input type="submit" name="btnSave" />
              </td>
            </tr>
          </table>
          <br />
          <table >
            <tr>
              <td>
                <?php echo $msgnum;?>
              </td>
              <td>
                <?php echo $acnumber;?>
              </td>
            </tr>
            <tr>
              <td>
                <?php echo $msgname;?>
              </td>
              <td>
                <?php echo $name1;?>
              </td>
            </tr>
          </table>
          <br />
          <table>
            <tr>
              <td>
                <?php echo $msgdate;?>
              </td>
              <td>
                <?php echo $msgnarration;?>
              </td>
              <td>
                <?php echo $msgcr;?>
              </td>
              <td>
                <?php echo $msgdr;?>
              </td>
              <td>
                <?php echo $msgbalance;?>
              </td>
            </tr>
            <?php
            while($row=mysqli_fetch_array($result2))
            {
            ?>
            <tr>
              <td>
                <?php echo $row['TransactionDate'];?>
              </td>
              <td>
                <?php echo $row['Narration'];?>
              </td>
              <td>
                <?php
                if($accountnum==$row['AccountIDcr'])
                {
                  $cramount=$row['Amount'];
                  echo $cramount;
                }
                ?>
              </td>
              <td>
                <?php
                if($accountnum==$row['AccountIDdr'])
                {
                  $dramount=$row['Amount'];
                  echo $dramount;
                }
                ?>
              </td>
              <td>
                <?php
                  if($accountnum==$row['AccountIDcr'])
                  {
                    $cramount=$row['Amount'];
                    $obalance=$obalance+$cramount;
                    echo $obalance;
                  }
                  else if($accountnum==$row['AccountIDdr'])
                  {
                    $cramount=$row['Amount'];
                    $obalance=$obalance-$cramount;
                    echo $obalance;
                  }
                 ?>
              </td>
            </tr>
          <?php } ?>
          </table>
          </form>
      </td>
    </tr>
      <tr>
        <td colspan="2">
          <?php include 'Footer.html';?>
        </td>
      </tr>
    </table>
</body>
</html>
