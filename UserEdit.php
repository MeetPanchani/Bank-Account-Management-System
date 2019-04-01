<?php
include_once 'DBConnection.php';
include_once 'Functions.php';
if(isset($_GET['AID']))
{
  $accountID=$_GET['AID'];
  $query="SELECT AccountNumber,HolderName1,HolderName2,ContactNo,Email,Line1,Line2,City,OpeningBalance,KYC,ClosingBalance FROM AccountMaster WHERE AccountID=$accountID";
  $result=mysqli_query($link,$query);
  while($row=mysqli_fetch_array($result))
  {
    $acnumber=$row['AccountNumber'];
    $name1=$row['HolderName1'];
    $name2=$row['HolderName2'];
    $contactno=$row['ContactNo'];
    $email=$row['Email'];
    $line1=$row['Line1'];
    $line2=$row['Line2'];
    $city=$row['City'];
    $obalance=$row['OpeningBalance'];
    $kycok=$row['KYC'];
    $cbalance=$row['ClosingBalance'];
  }
}
if(isset($_POST['accountID']))
{
if($_POST['btnSave']=='Save')
  {
    if($_POST['accountID']!=' ')
    {
    $result=editEntry($_POST['accountID'],$_POST['acnumber'],$_POST['acname1'],$_POST['acname2'],$_POST['contactno'],$_POST['email'],$_POST['txtline1'],$_POST['txtline2'],$_POST['txtcity'],$_POST['obalance'],$_POST['kycok'],$_POST['cbalance']);

    $imgfile ="imgphoto/imgp_".$_POST['accountID'].".jpg";
    move_uploaded_file($_FILES["photo"]["tmp_name"],$imgfile);

    $imgsign ="imgsign/imgs_".$_POST['accountID'].".jpg";
    move_uploaded_file($_FILES["sign"]["tmp_name"],$imgsign);

    header('Location:List.php');
  }
  else{
    $insquery="select max(AccountID) from PersonDetail";
    $res=mysqli_query($link,$insquery);
    $row  = mysqli_fetch_array($res);
    if(mysqli_affected_rows($link)==1)
      $id  = $row[0] + 1;
    else {
      $id  = 1;
    }

    $result=addEntry($id,$_POST['acnumber'],$_POST['acname1'],$_POST['acname2'],
    $_POST['contactNo'],$_POST['email'],$_POST['txtline1'],$_POST['txtline2'],$_POST['txtcity'],
    $_POST['obalance'],$_POST['kycok'],$_POST['cbalance']);

    header('Location:List.php');

  }
}
}
 ?>
<html>
<head>
  <title>Edit Entry</title>
  <link rel="stylesheet" href="style.css">
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
          include_once 'Menu.php';
        ?>
      </td>
      <td align="left" style="width:700px">
        <form method="post" enctype="multipart/form-data" action="UserEdit.php">
          <table align="left">
            <tr>
              <td>
                Account Number
              </td>
              <td>
                <input type="text" name="acnumber" value="<?php echo $acnumber;?>" size="40" />
                <input type="hidden" name="accountID" value="<?php echo $accountID;?>" />
              </td>
            </tr>
            <tr>
              <td>
                Photo
              </td>
              <td>
                <div class="photo">
                <?php
                $img ="imgphoto/imgp_".$accountID.".jpg";
                echo "<img src='$img' height='100px' width='100px' />";
                 ?>
                 </div>
              </td>
            </tr>
            <tr>
              <td>
                Name 1
              </td>
              <td>
                <input type="text" name="acname1" value="<?php echo $name1;?>" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                Name 2
              </td>
              <td>
                <input type="text" name="acname2" value="<?php echo $name2;?>" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                Contact No
              </td>
              <td>
                <input type="text" name="contactno" value="<?php echo $contactno;?>" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                Email
              </td>
              <td>
                <input type="text" name="email" value="<?php echo $email;?>" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                Line-1
              </td>
              <td>
                <input type="text" name="txtline1" value="<?php echo $line1;?>" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                Line-2
              </td>
              <td>
                <input type="text" name="txtline2" value="<?php echo $line2;?>" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                City
              </td>
              <td>
                <input type="text" name="txtcity" value="<?php echo $city;?>" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                Opening Balance
              </td>
              <td>
                <input type="number" name="obalance" value="<?php echo $obalance;?>" />
              </td>
            </tr>
            <tr>
              <td>
                KYC
              </td>
              <td>
                <div id="radio">
                <input type="radio" name="kycok" value="Yes"
                  <?php
                if($kycok=='Yes')
                {
                  echo 'checked="checked"';
                }
                  ?>
                >Yes</input>

                <input type="radio" name="kycok" value="No"
                  <?php
                if($kycok=='No')
                {
                  echo 'checked="checked"';
                }
                  ?>
                >No</input>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                Closing Balance
              </td>
              <td>
                <input type="number" name="cbalance" value="<?php echo $cbalance;?>" />
              </td>
            </tr>
            <tr>
              <td>
                Sign
              </td>
              <td>
                <div class="photo">
                <?php
                $img1 ="imgsign/imgs_".$accountID.".jpg";
                echo "<img src='$img1' height='100px' width='100px' />";
                 ?>
                 </div>
              </td>
            </tr>
            <tr>
              <td>
                Edit Photo
              </td>
              <td>
                <input type="file" name="photo" />
              </td>
            </tr>
            <tr>
              <td>
                Edit Sign
              </td>
              <td>
                <input type="file" name="sign" />
              </td>
            </tr>
            <tr>
              <td>
              </td>
              <td>
                <input type="submit" name="btnSave" value="Save" />
                <input type="reset" name="btnReset" value="Reset" />
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
