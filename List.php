<?php
include_once 'DBConnection.php';

$query="SELECT AccountID,AccountNumber,HolderName1,HolderName2,OpeningBalance FROM AccountMaster";
$result=mysqli_query($link,$query);
 ?>
<html>
<head>
  <title>List</title>
</head>
<body>
  <table align="center" width="800px">
    <tr>
      <td colspan="5">
        <?php include 'Header.html';?>
      </td>
    </tr>
    <tr>
      <td>
          <td valign="top">
            <?php
              include_once 'Menu.php';
            ?>
          </td>
          <td style="width:688px">
            <table>
              <tr>
                <td>
                  Accoun Number
                </td>
                <td>
                  Photo
                </td>
                <td>
                  Name 1
                </td>
                <td>
                  Name 2
                </td>
                <td>
                  Opening Balance
                </td>
                <td>
                  Sign
                </td>
                <td>
                  Edit Data
                </td>
                <td>
                  Delete Data
                </td>
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
                  <?php
                  $img ="imgphoto/imgp_".$row["AccountID"].".jpg";
                  echo "<img src='$img' height='100px' width='100px' />";

                  ?>
                </td>
                <td>
                  <?php echo $row['HolderName1'];?>
                </td>
                <td>
                  <?php echo $row['HolderName2'];?>
                </td>
                <td>
                  <?php echo $row['OpeningBalance'];?>
                </td>
                <td>
                  <?php
                  $img1 ="imgsign/imgs_".$row["AccountID"].".jpg";
                  echo "<img src='$img1' height='100px' width='100px' />";

                  ?>
                </td>
                <td>
                  <a href="UserEdit.php?AID=<?php echo $row['AccountID'];?>">Edit</a>
                </td>
                <td>
                  <a href="UserDelete.php?AID=<?php echo $row['AccountID'];?>">Delete</a>
                </td>
              </tr>
            <?php } ?>
            </table>
          </td>
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
