<?php
include 'DBConnection.php';
include 'Functions.php';
$checkname1='';
$crid='';
$crname="";
$drid='';
$drname='';
$name='';
$id='';
$amount='';
$narration='';
$inputtype='';
$trtype='';
$photoid1=0;
$photoid2=0;
$tdate=date("Y/m/d");
$insquery="select max(TransactionID) from Transaction";
$res=mysqli_query($link,$insquery);
$row  = mysqli_fetch_array($res);
if(mysqli_affected_rows($link)==1)
  $tid  = $row[0] + 1;
else {
  $tid  = 1;
  }
if(isset($_POST['btnSave'])=='Save')
{
  $result=addTransaction($tid,$tdate,$_POST['trtype'],$_POST['inputtype'],$_POST['acIDcr'],$_POST['acIDdr'],$_POST['amount'],$_POST['narration']);
  if($_POST['acIDdr']==9999)
  {
    $result3=editamount1($_POST['amount'],$_POST['acIDcr']);
    $result4=editamount2($_POST['amount'],9999);
  }
  else if($_POST['acIDcr']==9999)
  {
  $result3=editamount2($_POST['amount'],$_POST['acIDdr']);
  $result4=editamount1($_POST['amount'],9999);
  }
  else
  {
    $result3=editamount1($_POST['amount'],$_POST['acIDcr']);
    $result4=editamount2($_POST['amount'],$_POST['acIDdr']);
  }

  header('Location:Transaction.php');
}
if(isset($_POST['crname'])=='Save')
{
  $trtype=$_POST['trtype'];
  $inputtype=$_POST['inputtype'];
  $amount=$_POST['amount'];
  $narration=$_POST['narration'];
  $crid=$_POST['acIDcr'];
  $drid=$_POST['acIDdr'];
  $drname=$_POST['hname2'];
  $query="SELECT HolderName1,AccountID From AccountMaster WHERE AccountNumber=$crid";
  $result1=mysqli_query($link,$query);
  $num =mysqli_num_rows($result1);
  if($num>0)
  {
  $row=mysqli_fetch_array($result1);
    $crname=$row['HolderName1'];
    $photoid1=$row['AccountID'];
  }
  else {
    $crname="Account Not Found";
  }

}

if(isset($_POST['drname'])=='Save')
{
  $trtype=$_POST['trtype'];
  $inputtype=$_POST['inputtype'];
  $narration=$_POST['narration'];
  $crid=$_POST['acIDcr'];
  $drid=$_POST['acIDdr'];
  $crname=$_POST['hname1'];
  $query1="SELECT HolderName1,AccountID From AccountMaster WHERE AccountNumber=$drid";
  $result2=mysqli_query($link,$query1);
  $num1=mysqli_num_rows($result2);
  if($num1>0)
  {
  $row=mysqli_fetch_array($result2);
  $drname=$row['HolderName1'];
  $photoid2=$row['AccountID'];
  }
  else {
    $drname="Account Not Found";
  }
}


 ?>
<html>
<head>
  <title>New Transaction</title>
  
  <script language="javascript">

    function confTr()
    {
        var Ttrtype = document.frmtr.trtype.value;
        var Trinputtype = document.frmtr.inputtype.value ;
        //alert("Hi.."+Ttrtype + " "+Trinputtype);
        if(Ttrtype=="Cash" && Trinputtype=="Deposit")
        {
//  alert("Hi..DR.."+Ttrtype + " "+Trinputtype);

          document.frmtr.acIDdr.value="9999";
          document.frmtr.hname2.value="Cash";
          document.frmtr.acIDcr.value="";
        }else if(Ttrtype=="Cash" && Trinputtype=="Withdraw")
        {
  //alert("Hi.CR..."+Ttrtype + " "+Trinputtype);
          document.frmtr.acIDcr.value="9999";
          document.frmtr.hname1.value="Cash";
          document.frmtr.acIDdr.value="";
        }
        else {
          document.frmtr.acIDcr.value="";
          document.frmtr.acIDdr.value="";
        }


    }
  </script>
  <style>
  * {
  box-sizing: border-box;
  }
.marginl{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  margin-left: 50px;
}
.marginn{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}
input[type=submit]:hover {
  background-color: #45a049;
}
.submitb{
  margin-left: 60px;
  margin-right: 10px;
}
input[type=reset] {
  background-color: #ff4d4d;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin-right: 10px;
  margin-top: 10px;
}
input[type=reset]:hover {
  background-color: #ff1a1a;
}
#endsubmit {
  margin-top: 10px;
}
.marginln {
  margin-left: 50px;
}
input[type=button] {
  cursor: pointer;
  margin-top: 10px;
}
input[type=radio] {
  margin-top: 10px;
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
      <td align="left" style="width:688px">
        <form method="post" enctype="multipart/form-data" action="Transaction.php" name="frmtr">
          <table align="left">
            <tr>
              <td width="20%">
                Transaction ID
              </td>
              <td>
              <div class="marginln">
                <?php
                  echo $tid;
                 ?></div>
              </td>
            </tr>
            <tr>
              <td>
                Date
              </td>
              <td>
                <div class="marginln">
                <?php
                echo $tdate;
                 ?>
                 </div>
                <input type="hidden" name="date" />
              </td>
            </tr>
          </tr>
          <tr>
            <td>

            </td>
            <td>
              <div class="marginln">
              <input type="radio" name="trtype" value="Cash"
              <?php
            if($trtype=='Cash')
            {
              echo 'checked="checked"';
            }
              ?>
            >Cash</input>
              <input type="radio" name="trtype" value="Cheque"
              <?php
            if($trtype=='Cheque')
            {
              echo 'checked="checked"';
            }
              ?>
            >Cheque</input>
            </div>
            </td>
          </tr>
        </tr>
        <tr>
          <td>

          </td>
          <td>
          <div class="marginln">
            <input type="radio" name="inputtype"  value="Deposit"
            <?php
          if($inputtype=='Deposit')
          {
            echo 'checked="checked"';
          }
            ?>
          >Deposit</input>
            <input type="radio" name="inputtype" value="Withdraw"
            <?php
          if($inputtype=='Withdraw')
          {
            echo 'checked="checked"';
          }
            ?>
          >Withdraw</input>
          </div>
          </td>
        </tr>
        <tr>
          <td>

          </td>
          <td>
            <input type="button" name="typeselect" class="marginl" value="Confirm Transaction Type " onclick="confTr()"/>
          </td>
        </tr>
            <tr>
              <td>
                Account ID Cr
              </td>
              <td>
                <table>
                  <tr>
                <td><input type="text" name="acIDcr" class="marginl" value="<?php echo $crid;?>" size="20"/></td>
                <td><input type="submit" name="crname" class="submitb" /></td>
                <td><input type="text" name="hname1" class="marginn" value="<?php echo $crname;  ?>" size="25"/></td>
                <td><?php
                $img1 ="imgsign/imgs_".$photoid1.".jpg";
                echo "<img src='$img1' height='100px' width='100px' />";
                 ?></td>
               </tr>
             </table>
              </td>

            <tr>
              <td>
                Account ID Dr
              </td>
              <td>
                <table>
                  <tr>

                <td><input type="text" name="acIDdr" class="marginl" value="<?php echo $drid;?>" size="20"/></td>
                <td><input type="submit" name="drname"  class="submitb"/></td>
                <td><input type="text" name="hname2" class="marginn" value="<?php echo $drname;  ?>" size="25"/></td>
                <td><?php
                $img2 ="imgsign/imgs_".$photoid2.".jpg";
                echo "<img src='$img2' height='100px' width='100px' />";
                 ?></td>
               </tr>
             </table>
              </td>
            </tr>
            <tr>
              <td>
                Amount
              </td>
              <td>
                <input type="number" name="amount" class="marginl" size="10" value="<?php echo $amount;?>" />
              </td>
            </tr>
            <tr>
              <td>
                Narration
              </td>
              <td>
                <input type="text" name="narration" class="marginl" size="10" value="<?php echo $narration;?>"/>
              </td>
            </tr>
              <tr>
              <td>
              </td>
              <td>
                <input type="submit" name="btnSave" id="endsubmit" />
                <input type="reset" name="btnReset" />
              </td>
            </tr>
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
