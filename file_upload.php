  <?php


  $Email = $FileError = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
    $Email = test_input($_POST["Email"]);
    $File = $_FILES["File"];
    

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) 
    {
      $EmailError = "Error. Enter a valid email address.";
    }
    
    $AllowedExtensions = array("png", "jpeg", "jpg");
    $FileExtension = strtolower(pathinfo($File["Name"], PATHINFO_EXTENSION));
    
    if (!in_array($FileExtension, $AllowedExtensions)) {
      $FileError = "Please select a JPEG or PNG file.";
    }
    
    // If both email and file are valid, proceed with file upload and database insertion
    if (empty($EmailError) && empty($FileError)) 
    {
      $TargetDirectory = "uploads/";
      $TargetFile = $TargetDirectory . basename($File["Name"]);
      
      if (move_uploaded_file($File["tmp_name"], $TargetFile)) {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO Files (Email, filename) VALUES (?, ?)");
        $stmt->bind_param("ss", $Email, $TargetFile);
        
        // Execute the statement
        if ($stmt->execute()) 
        {
          echo "File uploaded successfully.";
        } else 
        {
          echo "Sorry, there was an error uploading your file.";
        }
        
        // Close the statement
        $stmt->close();
      } else 
      {
        echo "Error uploading your file.";
      }
    }
  }
  
  function test_input($Data) 
  {
    $Data = trim($Data);
    $Data = stripslashes($Data);
    $Data = htmlspecialchars($Data);
    return $Data;
  }
  