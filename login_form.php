  <!DOCTYPE html>
<html>
<head>
  <title>File Upload Form</title>
  <style>
    .error {
      color: red;
    }
  </style>
</head>
<body>
  <h1>File Upload Form</h1>
  

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="Email">Email:</label>
    <input type="Email" id="Email" name="Email" required>
    <span class="Error"><?php echo $EmailError; ?></span><br><br>
    
    <label for="File">Upload File (JPEG or PNG):</label>
    <input type="File" id="File" name="File" accept="image/jpeg, image/png" required>
    <span class="Error"><?php echo $FileError; ?></span><br><br>
    
    <input type="Submit" value="Upload">
  </form>
</body>
</html>