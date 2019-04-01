<?php
  include_once 'Functions.php';
  if(isset($_GET['AID']))
  {
    $accountID=$_GET['AID'];
    $result=deleteEntry($accountID);
    if($result)
    {
      header('Location:List.php');
    }
  }
 ?>
 <html>
 <head>
    <title>Delete Entry</title>
 </head>
 <body>
   <table align="center" width="800px">
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
       <td>
         <?php
         if($result=='Delete'){
           ?>
           This data deleted successfully.
           Back to<a href="List.php">List Page</a>
         <?php }?>
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
