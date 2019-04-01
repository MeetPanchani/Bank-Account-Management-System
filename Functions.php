<?php
function addEntry($accountID,$number,$name1,$name2,$contactNo,$email,$line1,$line2,$city,$obalance,$kycok,$cbalance)
{
  $hostName='localhost';
  $database='meetbank';
  $userName='root';
  $password='';

  $link=mysqli_connect($hostName,$userName,$password);
  mysqli_select_db($link,$database);
  $query="INSERT INTO AccountMaster(AccountID,AccountNumber,HolderName1,HolderName2,ContactNo,Email,Line1,Line2,City,OpeningBalance,KYC,ClosingBalance)
  VALUES($accountID,'$number','$name1','$name2','$contactNo','$email','$line1','$line2','$city',$obalance,'$kycok',$cbalance)";
  $result=mysqli_query($link,$query);
  if($result)
  {
    return 'Save';
  }
  else {
    return 'Error';
  }
}

function editEntry($accountID,$acnumber,$name1,$name2,$contactno,$email,$line1,$line2,$city,$obalance,$kycok,$cbalance)
{
  $hostName='localhost';
  $database='meetbankdata';
  $userName='root';
  $password='';

  $link=mysqli_connect($hostName,$userName,$password);
  mysqli_select_db($link,$database);
  $query="UPDATE AccountMaster SET
  AccountNumber='$acnumber',HolderName1='$name1',HolderName2='$name2',
  ContactNo='$contactno',Email='$email',Line1='$line1',
  Line2='$line2',City='$city',OpeningBalance='$obalance',KYC='$kycok',ClosingBalance='$cbalance' WHERE AccountID=$accountID";
  $result=mysqli_query($link,$query);
  if($result)
  {
    return 'Update';
  }
  else {
    return 'Error';
  }
}

function deleteEntry($accountID)
{
  $hostName='localhost';
  $database='meetbankdata';
  $userName='root';
  $password='';

  $link=mysqli_connect($hostName,$userName,$password);
  mysqli_select_db($link,$database);
  $query="DELETE FROM AccountMaster WHERE AccountID=$accountID";
  $result=mysqli_query($link,$query);
  if($result)
  {
    return 'Delete';
  }
  else {
    return 'Error';
  }
}

function addTransaction($tid,$tdate,$type,$inputtype,$idcr,$iddr,$amount,$narration)
{
  $hostName='localhost';
  $database='meetbankdata';
  $userName='root';
  $password='';

  $link=mysqli_connect($hostName,$userName,$password);
  mysqli_select_db($link,$database);
  $query="INSERT INTO Transaction(TransactionID,TransactionDate,Type,InputType,AccountIDcr,AccountIDdr,Amount,Narration)
  VALUES('$tid','$tdate','$type','$inputtype','$idcr','$iddr','$amount','$narration')";
//  echo $query;
  $result=mysqli_query($link,$query);
  if($result)
  {
    return 'Save';
  }
  else {
    return 'Error';
  }
}

function editamount1($amount,$accountnum)
{
  $hostName='localhost';
  $database='meetbankdata';
  $userName='root';
  $password='';

  $link=mysqli_connect($hostName,$userName,$password);
  mysqli_select_db($link,$database);
  $query="SELECT ClosingBalance From AccountMaster WHERE AccountNumber=$accountnum";
  $result=mysqli_query($link,$query);
  $row=mysqli_fetch_array($result);
  $cbalance=$row['ClosingBalance'];
  $total=$cbalance+$amount;
  $query1="UPDATE AccountMaster SET ClosingBalance='$total' WHERE AccountNumber=$accountnum";
  $result1=mysqli_query($link,$query1);
  if($result1)
  {
    return 'Update';
  }
  else {
    return 'Error';
  }

}
function editamount2($amount,$accountnum)
{
  $hostName='localhost';
  $database='meetbankdata';
  $userName='root';
  $password='';

  $link=mysqli_connect($hostName,$userName,$password);
  mysqli_select_db($link,$database);
  $query="SELECT ClosingBalance From AccountMaster WHERE AccountNumber=$accountnum";
  $result=mysqli_query($link,$query);
  $row=mysqli_fetch_array($result);
  $cbalance=$row['ClosingBalance'];
  $total=$cbalance-$amount;
  $query1="UPDATE AccountMaster SET ClosingBalance='$total' WHERE AccountNumber=$accountnum";
  $result1=mysqli_query($link,$query1);
  if($result1)
  {
    return 'Update';
  }
  else {
    return 'Error';
  }

}

 ?>
