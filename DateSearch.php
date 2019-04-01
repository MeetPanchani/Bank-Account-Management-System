<?php
include 'DBConnection.php';
$totalamount=0;
if(isset($_POST['btnSave1'])=='Save')
{
  $tdate=$_POST['datesearch'];
  $query1="SELECT * FROM Transaction WHERE TransactionDate='$tdate' ";
  $result1=mysqli_query($link,$query1);
}
 ?>
<html>
<head>
  <title>Day Book</title>
  <style>
  * {
  box-sizing: border-box;
  }
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
      <td align="left" style="width:700px">
        <form method="post" enctype="multipart/form-data" action="DateSearch.php">
          <table align="center">
            <tr>
              <th colspan="2">
                <b>Show Ledger</b>
              </th>
            </tr>
            <tr>
              <td>
                Date
              </td>
              <td>
                <input type="text" name="datesearch" />
                <input type="submit" name="btnSave1" />
              </td>
            </tr>
          </table>
          <?php if(isset($_POST['btnSave1'])=='Save')
          {
          ?>
          <table width="700px">
            <tr>
              <td>
                Transaction Date
              </td>
              <td>
                <?php echo $tdate;?>
              </td>
            </tr>
          </table>
          <table>
            <tr>
              <td>
                <b>Transaction ID</b>
              </td>
              <td>
                <b>Type</b>
              </td>
              <td>
                <b>Input Type</b>
              </td>
              <td>
                <b>Account ID cr</b>
              </td>
              <td>
                <b>Account Id dr</b>
              </td>
              <td>
                <b>Amount</b>
              </td>
              <td>
                <b>Narration</b>
              </td>
            </tr>
            <?php
            while($row=mysqli_fetch_array($result1))
            {
             ?>
             <tr>
               <td>
                 <?php echo $row['TransactionID'];?>
               </td>
               <td>
                 <?php echo $row['Type'];?>
               </td>
               <td>
                 <?php echo $row['InputType'];?>
               </td>
               <td>
                 <?php echo $row['AccountIDcr'];?>
               </td>
               <td>
                 <?php echo $row['AccountIDdr'];?>
               </td>
               <td>
                 <?php echo $row['Amount'];
                 $amount=$row['Amount'];
                 $totalamount=$totalamount+$amount;
                 ?>
               </td>
               <td>
                 <?php echo $row['Narration'];?>
               </td>
             </tr>
           <?php } ?>
           <tr>
             <td><hr /></td>
             <td><hr /></td>
             <td><hr /></td>
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
             <td>
               &nbsp;
             </td>
             <td>
               &nbsp;
             </td>
             <td>
               &nbsp;
             </td>
             <td>
               <?php echo $totalamount;?>
             </td>
           </tr>
          </table>
        <?php } ?>
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
