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
$msgobalance='';
$msgtotal='';
$meetrow='';
$ledlist="";


if(isset($_POST['btnSave'])=='Save')
{
  $totalbalance=0;
  $totalcr=0;
  $totaldr=0;
  $meetrow='<tr><td><hr /></td><td><hr /> </td><td><hr /></td><td><hr /></td><td><hr /></td></tr><tr>';

  $accountnum=$_POST['acnumber'];
  $query1="SELECT AccountNumber,HolderName1,OpeningBalance,ClosingBalance from AccountMaster WHERE AccountNumber=$accountnum ";
  $result1=mysqli_query($link,$query1);
  $row=mysqli_fetch_array($result1);

    $acnumber=$row['AccountNumber'];
    $name1=$row['HolderName1'];
    $obalance=$row['OpeningBalance'];
    $cbalance=$row['ClosingBalance'];
    $totalcr=$obalance;

  $msgnum="Account Number : ";
  $msgname="Account Holder Name : ";
  $msgobalance="Opening Balance";
  $msgtotal="<b>Total</b>";

  $query2="SELECT * from Transaction where AccountIDcr=$accountnum or AccountIDdr=$accountnum order by TransactionDate";
  $result2=mysqli_query($link,$query2);

  $msgdate="<b>Date</b>";
  $msgnarration="<b>Narration</b>";
  $msgcr="<b>CR</b>";
  $msgdr="<b>DR</b>";
  $msgbalance="<b>Balance</b>";


}
$query1="SELECT AccountNumber,HolderName1 from AccountMaster";
$result1=mysqli_query($link,$query1);
$ledlist="<select name='acnumber'>";
$ledlist=$ledlist."<option value='0' >----- Select Account Name ----- </option>";

while ($row=mysqli_fetch_array($result1)) {
if($accountnum==$row["AccountNumber"])
{
  $ledlist=$ledlist."<option value='".$row["AccountNumber"]."' selected >".$row["HolderName1"]."</option>";
}
else {
  $ledlist=$ledlist."<option value='".$row["AccountNumber"]."' >".$row["HolderName1"]."</option>";
}

}
$ledlist=$ledlist."</select>";
 ?>
<html>
<head>
  <title>Details</title>
  <style>
    input[type=text], select, textarea{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  margin-top: 40px;
}
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin-top: 15px;
}
input[type=submit]:hover {
  background-color: #45a049;
}
  </style>
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
          <table align="center" width:"700px" >
            <tr>
              <th colspan="2">
                <b>Show Ledger</b>
              </th>
            </tr>
            <tr>
              <td>
                Account Name
              </td>
              <td>
                <?php echo $ledlist;?>
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
          <table border="0" width="700px">
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
            <?php echo $meetrow;?>
            <tr>
              <td>
                &nbsp;
              </td>
              <td>
                <?php echo $msgobalance;?>
              </td>
              <td align="right">
                <?php echo $obalance;?>
              </td>
              <td align="right">
                &nbsp;
              </td>
              <td align="right">
                <?php echo $obalance;?>
              </td>
            </tr>
            <?php
            if(isset($_POST["btnSave"])=="Save")

            {
            while($row=mysqli_fetch_array($result2))
            {
            ?>
            <tr>
              <td >
                <?php echo $row['TransactionDate'];?>
              </td>
              <td>
                <?php echo $row['Narration'];?>
              </td>
              <td align="right">
                <?php
                if($accountnum==$row['AccountIDcr'])
                {
                  $cramount=$row['Amount'];
                  $totalcr=$totalcr+$cramount;
                  echo abs($cramount);
                }
                ?>
              </td>
              <td align="right">
                <?php
                if($accountnum==$row['AccountIDdr'])
                {
                  $dramount=$row['Amount'];
                  $totaldr=$totaldr+$dramount;
                  echo abs($dramount);
                }
                ?>
              </td>
              <td align="right">
                <?php
                  if($accountnum==$row['AccountIDcr'])
                  {
                    $cramount=$row['Amount'];
                    $obalance=$obalance+$cramount;
                    echo abs($obalance);
                  }
                  else if($accountnum==$row['AccountIDdr'])
                  {
                    $cramount=$row['Amount'];
                    $obalance=$obalance-$cramount;
                    echo abs($obalance);
                  }
                 ?>
              </td>
            </tr>
          <?php }} ?>
          <tr></tr>
          <?php if(isset($_POST['btnSave'])=='Save'){
          ?>
          <tr>
            <td><hr /></td>
            <td><hr /></td>
            <td><hr /></td>
            <td><hr /></td>
            <td><hr /></td>
          </tr>
          <tr>
            <td>
              <?php echo $msgtotal;?>
            </td>
            <td>&nbsp;</td>
            <td align="right">
              <?php echo abs($totalcr);?>
            </td>
            <td align="right">
              <?php echo abs($totaldr);?>
            </td>
            <td align="right">
              <?php echo abs($obalance);?>
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
