<?php
if(isset($_POST['btnSave'])=='Submit')
{
$name=$_POST['name'];
$email=$_POST['email'];
$msg="Thank You,".$name."\n \t We have been Working on your responce";
mail($email,"My Subject",$msg);

}
 ?>
<html>
<head>
  <title>Contact Us</title>
</head>
<body>
  <table width="800px" align="center">
    <tr>
      <td colspan="2">
        <?php include 'Header.html';?>
      </td>
    </tr>
    <tr>
      <td>
        <?php
        include 'Menu.php'; ?>
      </td>
      <td align="left">
        <form method="post" enctype="multipart/form-data" action="ContactUs.php">
          <table align="left">
            <tr>
              <td>
                Name
              </td>
              <td>
                <input type="text" name="name" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                Email
              </td>
              <td>
                <input type="text" name="email" size="40"/>
              </td>
            </tr>
            <tr>
              <td>
                Mobile No.
              </td>
              <td>
                <input type="text" name="mobileno" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                Country
              </td>
              <td>
                <input type="text" name="country" size="40" />
              </td>
            </tr>
            <tr>
              <td>
                Message
              </td>
              <td>
                <input type="text" name="country" size="40" />
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
  </table>
</body>
</html>
