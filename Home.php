<html>
<head>
  <title>Home</title>
</head>
<body>
  <table width="950px" align="center">
    <tr>
      <td colspan="3">
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
        <form method="post" enctype="multipart/form-data" action="Home.php">
          <table>
            <tr>
              <td>
                <img src="projectimg/sbioffer.jpg" border="0" height="300px" width="250px"/>
                <img src="projectimg/sbioffer3.png" border="0" height="300px" width="250px"/>
              </td>
            </tr>
            <tr>
              <img src="projectimg/sbioffer1.jpg" border="0" height="300px" width="500px"/>
            </tr>
          </table>
        </form>
      </td>
      <td valign=top>
        <?php
        include 'Links.html';
         ?>
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
