<?php
$id="";
include_once 'DBConnection.php';
include_once 'Functions.php';
if(isset($_POST['btnSave'])=='Save')
{
  $insquery="select max(AccountID) from AccountMaster";
  $res=mysqli_query($link,$insquery);
  $row  = mysqli_fetch_array($res);
  if(mysqli_affected_rows($link)==1)
    $id  = $row[0] + 1;
  else {
    $id  = 1;
  }

  $result=addEntry($id,$_POST['acnumber'],$_POST['acname1'],$_POST['acname2'],
  $_POST['contactNo'],$_POST['email'],$_POST['txtline1'],$_POST['txtline2'],$_POST['txtcity'],
  $_POST['obalance'],$_POST['kycok'],$_POST['obalance']);

  $imgfile ="imgphoto/imgp_".$id.".jpg";
  move_uploaded_file($_FILES["userphoto"]["tmp_name"],$imgfile);

  $imgsign ="imgsign/imgs_".$id.".jpg";
  move_uploaded_file($_FILES["usersign"]["tmp_name"],$imgsign);

  header('Location:List.php');

}
if(isset($_POST['btnReset'])=='Reset')
{
  header('Location:AddNewEntry.php');
}

 ?>
<html>
<head>
  <title>Add New Account</title>
  <link rel="stylesheet" href="style.css">
    </head>
    
<body>
  <table width="800px" align="center" >
    <tr>
      <td colspan="2">
        <?php include 'Header.html';?>
      </td>
    </tr>
    <tr>
      <td valign="top">
        <div class="menu">
        <?php
        include 'Menu.php';
         ?>
         </div>
      </td>
      <td align="left" style="width:688px">
        <form method="post"  enctype="multipart/form-data" action="AddNewAccount.php">
          <table align="left">
            <tr>
              <td>
                    Account Number
              </td>
              <td>  
                    <input type="text"  name="acnumber" size="40" placeholder="Account Number..."/>
                    <input type="hidden" name="accountID"  />
                  
                </td>
                
              </td>
            </tr>
            <tr>
              <td>
            Photo
              </td>
              <td>
              
                <input type="file"  name="userphoto" />
              
              </td>
              
            </tr>
            <tr>
              <td>
                
                Holder Name 1
              </td>
              <td>
              
                <input type="text"  name="acname1" size="40" placeholder="Holder Name 1..."/>
              
              </td>
              
            </tr>
            <tr>
              <td>
                Holder Name 2
              </td>
              <td>
                <input type="text" name="acname2" size="40" placeholder="Holder Name 2..."/>
              </td>
            </tr>
            <tr>
              <td>
                Contact No
              </td>
              <td>
                <input type="text" name="contactNo" size="40" placeholder="Contact No..."/>
              </td>
            </tr>
            <tr>
              <td>
                Email
              </td>
              <td>
                <input type="text" name="email" size="40" placeholder="name@domain.com"/>
              </td>
            </tr>
            <tr>
              <td>
                <div id="address">
                Address
                </div>
              </td>
            </tr>
            <tr>
              <td>
                Line 1
              </td>
              <td>
                <input type="text" name="txtline1" size="40" placeholder="line 1..."/>
              </td>
            </tr>
            <tr>
              <td>
                Line 2
              </td>
              <td>
                <input type="text" name="txtline2" size="40" placeholder="line 2..."/>
              </td>
            </tr>
            <tr>
              <td>
                City
              </td>
              <td>
                <input type="text" name="txtcity" placeholder="City"/>
              </td>
            </tr>
            <tr>
              <td>
                Opening Balance
              </td>
              <td>
                <input type="number" name="obalance" />
              </td>
            </tr>
            <tr>
              <td>
                KYC
              </td>
              <td>
                <div id="radio">
                <input type="radio" name="kycok" value="Yes" >Yes</input>
                <input type="radio" name="kycok" value="No" >No</input>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                Sign
              </td>
              <td>
                <input type="file" name="usersign" />
              </td>
            </tr>
              <tr>
              <td>
              </td>
              <td>
                <input type="submit" name="btnSave" />
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
