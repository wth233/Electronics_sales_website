<?php

      $servername = "localhost";
      $username = "root";
      $password = "mysql";
      $database = "ecommerce";
      $conn = new mysqli($servername, $username, $password, $database);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "";
      switch($_GET[action]){
        case 'The amount of new products each month': $sql = "select month(date) as n, count(1) as t from product group by month(date);";
        break;
        case 'The top 10 products with most order placed': $sql = "select a.id as n, count(1) as t from product a, product_transaction b where a.id=b.product_id group by a.id order by count(1) desc limit 10;";
        break;
        case 'The top 10 categories with most order placed': $sql = "select c.categories as n, count(1) as t from product a, product_transaction b, category c where a.id=b.product_id and a.categories = c.id group by c.id order by count(1) desc limit 10;";
        break;
      }

      $result = $conn->query($sql);
      $output = "letter\tfrequency\n";
      if ($result){
        while($row = $result->fetch_assoc())
        {
            $output .= $row['n']."\t".$row['t']."\n";
        }
      }
      $result->free();

      echo $output;

      // Close connection
      mysqli_close($conn);

?>
