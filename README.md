# Web Service mini-project


## 1 - REST Web Service

   ![Packaging Structure](https://i.ibb.co/hYJqkKP/Screen-Shot-2020-04-23-at-16-49-29.png?raw=true)

### a) Tools and Technologies Used
  * Spring Boot - 2.0.4.RELEASE
  * JDK - 1.8 or later
  * Spring Framework - 5.0.8 RELEASE
  * Hibernate - 5.2.17.Final
  * JPA
  * Maven - 3.2+
  * IDE - Eclipse
  * Mysql Connector Database
  
### b) Creating and Importing a Project
   Initializr generates spring boot project with just what you need to start quickly!
   [Initializr generates spring](https://start.spring.io)

### c) Packaging Structure
   ![Packaging Structure](https://i.ibb.co/3RPGXXd/Screen-Shot-2020-04-23-at-15-49-34.png?raw=true)
   
### d) The pom.xml File
```xml
<?xml version="1.0" encoding="UTF-8"?>
<project xmlns="http://maven.apache.org/POM/4.0.0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://maven.apache.org/POM/4.0.0 https://maven.apache.org/xsd/maven-4.0.0.xsd">
	<modelVersion>4.0.0</modelVersion>
	<parent>
		<groupId>org.springframework.boot</groupId>
		<artifactId>spring-boot-starter-parent</artifactId>
		<version>2.1.14.BUILD-SNAPSHOT</version>
		<relativePath/> <!-- lookup parent from repository -->
	</parent>
	<groupId>laamarti.hlali.aouragh.elghiwach</groupId>
	<artifactId>Mini-Project-Web-Services</artifactId>
	<version>0.0.1-SNAPSHOT</version>
	<name>Mini-Project-Web-Services</name>
	<description>project for Web Services</description>

	<properties>
		<java.version>1.8</java.version>
	</properties>

	<dependencies>
		<dependency>
			<groupId>org.springframework.boot</groupId>
			<artifactId>spring-boot-starter-data-jpa</artifactId>
		</dependency>
		<dependency>
			<groupId>org.springframework.boot</groupId>
			<artifactId>spring-boot-starter-web</artifactId>
		</dependency>

		<dependency>
			<groupId>org.springframework.boot</groupId>
			<artifactId>spring-boot-starter-test</artifactId>
			<scope>test</scope>
		</dependency>
		    <dependency>
            <groupId>mysql</groupId>
            <artifactId>mysql-connector-java</artifactId>
            <version>8.0.13</version>
        </dependency>
	</dependencies>

	<build>
		<plugins>
			<plugin>
				<groupId>org.springframework.boot</groupId>
				<artifactId>spring-boot-maven-plugin</artifactId>
			</plugin>
		</plugins>
	</build>

	<repositories>
		<repository>
			<id>spring-milestones</id>
			<name>Spring Milestones</name>
			<url>https://repo.spring.io/milestone</url>
		</repository>
		<repository>
			<id>spring-snapshots</id>
			<name>Spring Snapshots</name>
			<url>https://repo.spring.io/snapshot</url>
			<snapshots>
				<enabled>true</enabled>
			</snapshots>
		</repository>
	</repositories>
	<pluginRepositories>
		<pluginRepository>
			<id>spring-milestones</id>
			<name>Spring Milestones</name>
			<url>https://repo.spring.io/milestone</url>
		</pluginRepository>
		<pluginRepository>
			<id>spring-snapshots</id>
			<name>Spring Snapshots</name>
			<url>https://repo.spring.io/snapshot</url>
			<snapshots>
				<enabled>true</enabled>
			</snapshots>
		</pluginRepository>
	</pluginRepositories>

</project>

```
### e) Configure Mysql Database

``` application.properties
 spring.datasource.platform=h2
 spring.datasource.url=jdbc:mysql://localhost:3306/test
 spring.datasource.username=root
 spring.datasource.password=
 spring.datasource.driverClassName=com.mysql.cj.jdbc.Driver
 spring.jpa.hibernate.ddl-auto =create

```
### f) Create JPA Entity - CreditCard.java
``` java
 import javax.persistence.Column;
 import javax.persistence.Entity;
 import javax.persistence.GeneratedValue;
 import javax.persistence.GenerationType;
 import javax.persistence.Id;
 import javax.persistence.Table;

 @Entity
 @Table( name = "CreditCard")
 public class CreditCard {

  @Id
  @GeneratedValue(strategy = GenerationType.AUTO)
  private long id;

  @Column(name = "number")
  private String number; 

  @Column(name = "expiry_date")
  private String expiryDate;

  @Column(name = "control_number")
  private Integer controlNumber;

  @Column(name = "type")
  private String type;


  public CreditCard() {
   super();
  }


  public CreditCard(long id, String number, String expiryDate, Integer controlNumber, String type) {
   super();
   this.id = id;
   this.number = number;
   this.expiryDate = expiryDate;
   this.controlNumber = controlNumber;
   this.type = type;
  }


  public long getId() {
   return id;
  }


  public void setId(long id) {
   this.id = id;
  }


  public String getNumber() {
   return number;
  }


  public void setNumber(String number) {
   this.number = number;
  }


  public String getExpiryDate() {
   return expiryDate;
  }


  public void setExpiryDate(String expiryDate) {
   this.expiryDate = expiryDate;
  }


  public Integer getControlNumber() {
   return controlNumber;
  }


  public void setControlNumber(Integer controlNumber) {
   this.controlNumber = controlNumber;
  }


  public String getType() {
   return type;
  }


  public void setType(String type) {
   this.type = type;
  }


  @Override
  public String toString() {
   return "CreditCard [id=" + id + ", number=" + number + ", expiryDate=" + expiryDate + ", controlNumber="
     + controlNumber + ", type=" + type + "]";
  }



 }

```


### g) Create a Spring Data Repository - CreditCardRepository.java

``` java
 import org.springframework.data.jpa.repository.JpaRepository;
 import org.springframework.stereotype.Repository;

 import laamarti.hlali.aouragh.elghiwach.model.CreditCard;

 @Repository
 public interface CreditCardRepository extends JpaRepository<CreditCard,Long> {
 }
```

### h) Create Spring Rest Controller - CreditCardController.java
```java
  @RestController
  @RequestMapping("/api/v1")
  public class CreditCardController {

   @Autowired
   private CreditCardRepository creditCardRepository;

   // create get all CreditCard api
   @GetMapping("/creditcard")
   public List<CreditCard> getAllCreditCard(){
    return creditCardRepository.findAll();
   }

   // create CreditCard
   @PostMapping("/creditcard")
   public String createCreditCard(@Valid @RequestBody CreditCard creditCard) {

    if(validateCreditCardNumber(creditCard.getNumber()))
     creditCardRepository.save(creditCard);
    else
     return " is an invalid credit card number";

    return "your credit card has been credited " + creditCard.toString();
   }


   // get CreditCard by id
   @GetMapping("/creditcard/{id}")
   public ResponseEntity<CreditCard> getCreditCardById(@PathVariable(value = "id") long id)

    throws ResourceNotFoundException {
    CreditCard creditCard = creditCardRepository.findById(id)
    .orElseThrow(() -> new ResourceNotFoundException("CreditCard not found for this id :: " + id));


          return ResponseEntity.ok().body(creditCard);

   }


   // update CreditCard
    @PutMapping("/creditcard/{id}")
    public ResponseEntity < CreditCard > updateCreditCard(@PathVariable(value = "id") Long id,

    @Valid @RequestBody CreditCard CreditCardDetails) throws ResourceNotFoundException {
    CreditCard creditCard = creditCardRepository.findById(id)
               .orElseThrow(() -> new ResourceNotFoundException("CreditCard not found for this id :: " + id));

    creditCard.setNumber(creditCard.getNumber());
    creditCard.setExpiryDate(CreditCardDetails.getExpiryDate());
    creditCard.setControlNumber(CreditCardDetails.getControlNumber());
    creditCard.setType(CreditCardDetails.getType());

    final CreditCard updatedCreditCard = creditCardRepository.save(creditCard);

    return ResponseEntity.ok(updatedCreditCard);
   }


   // delete CreditCard by id
   @DeleteMapping("/creditcard/{id}")
   public Map < String, Boolean > deleteCreditCard(@PathVariable(value = "id") Long id)
       throws ResourceNotFoundException {
     CreditCard creditCard = creditCardRepository.findById(id)
               .orElseThrow(() -> new ResourceNotFoundException("CreditCard not found for this id :: " + id));

     creditCardRepository.delete(creditCard);
        Map < String, Boolean > response = new HashMap < > ();
           response.put("deleted", Boolean.TRUE);

           return response;
   }

  }
  
 ```
### i) Credit Card Validation Luhn Algorithm

From the rightmost digit, we should double every second digit. If the double is greater than 9, then add the both digits so that final number is of single digit.

Now sum all the digits in the number, the unchanged numbers and the doubled numbers.

The final sum should be multiple of 10 or mod 10 of the number should be 0. If it’s not then its not a valid credit card number.

Let’s check it with an example credit card number 12345678903555.

Digits are : 1,2,3,4,5,6,7,8,9,0,3,5,5,5
After doubling : 2,2,6,4,1,6,5,8,9,0,6,5,1,5
Sum of digits : 2+2+6+4+1+6+5+8+9+0+6+5+1+5 = 60 = 6*10 and hence a valid credit card number.
Luhn Algorithm in Java

 ``` java
   private boolean validateCreditCardNumber(String str) {

       int[] ints = new int[str.length()];
       for (int i = 0; i < str.length(); i++) {
           ints[i] = Integer.parseInt(str.substring(i, i + 1));
       }
       for (int i = ints.length - 2; i >= 0; i = i - 2) {
           int j = ints[i];
           j = j * 2;
           if (j > 9) {
               j = j % 10 + 1;
           }
           ints[i] = j;
       }
       int sum = 0;
       for (int i = 0; i < ints.length; i++) {
           sum += ints[i];
       }
       if (sum % 10 == 0)
        return true;

       return false;

   }
 ```
 
 ### j) Exception(Error) Handling for RESTful Services - ResourceNotFoundException.java
  ``` java
  @ResponseStatus(value = HttpStatus.NOT_FOUND)
  public class ResourceNotFoundException extends Exception{

      private static final long serialVersionUID = 1L;

      public ResourceNotFoundException(String message){
          super(message);
      }
  }

  ``` 
 ### k) Running Application
 ``` java 
@SpringBootApplication
public class MiniProjectWebServicesApplication {

	public static void main(String[] args) {
		SpringApplication.run(MiniProjectWebServicesApplication.class, args);
	}

}
```


## 1 - Web Service : .NET


### a) Tools and Technologies Used
  * Visual Studio
  * NewTonsof.Json
  * System.IO
  * System.Net

  
### b) Packaging Structure 

   ![Packaging Structure](https://i.ibb.co/KFzP4T5/Winapp.png?raw=true)
   
### c) Create New Form :

   ![Packaging Structure](https://i.ibb.co/hYdYwGb/form.png?raw=true)
   
## Form.cs

``` c#
  public partial class Form1 : Form
    {
        string url = "http://localhost:8080/api/v1/creditcard/";

  


        public Form1()
        {
            InitializeComponent();
        }
        private void Form1_Load(object sender, EventArgs e)
        {
            id_mod.Text = "None";
            Show_ALL();


        }
        void Show_ALL()
        {
            var webRequest = (HttpWebRequest)WebRequest.Create(url);
            var webResponse = (HttpWebResponse)webRequest.GetResponse();

            var reader = new StreamReader(webResponse.GetResponseStream());
            string s = reader.ReadToEnd();
            var arr = JsonConvert.DeserializeObject<JArray>(s);
            dataGridView1.DataSource = arr;
        }

       

        private void button1_Click(object sender, EventArgs e)
        {
            // Show ALL

            Show_ALL();
            
        }




        private void button1_aj_Click(object sender, EventArgs e)
        {
            string message = "Are you sure to Edit this client !!";
            string title = "Modification";

            //Modifier => PUT
            try
            {
             
                    var httpWebRequest = (HttpWebRequest)WebRequest.Create(url + id_mod.Text);
                    httpWebRequest.ContentType = "application/json";
                    httpWebRequest.Method = "PUT";

            using (var streamWriter = new StreamWriter(httpWebRequest.GetRequestStream()))
             { 
              string json = " {\r\n      \r\n        \"number\": \"" + textBox2.Text + "\",\r\n        \"expiryDate\": \"" + textBox3.Text + "\",\r\n        \"controlNumber\": " + textBox4.Text + ",\r\n        \"type\": \"" + comboBox1.Text + "\"\r\n    }";
                        streamWriter.Write(json);


             }


                var httpResponse = (HttpWebResponse)httpWebRequest.GetResponse();
               
                MessageBoxButtons buttons = MessageBoxButtons.YesNo;
                DialogResult r = MessageBox.Show(message, title, buttons);
                if (r == DialogResult.Yes)
                {
                    using (var streamReader = new StreamReader(httpResponse.GetResponseStream()))
                    {
                        var result = streamReader.ReadToEnd();
                    }
                    Show_ALL();
                    Emptyfield();
                    MessageBox.Show("Customer is Correctly Modify");
                }
                else
                    MessageBox.Show("Operation failed");
            }
            catch 
            {
                MessageBox.Show("Double click on the ROW that you want to modify on the DataGridView");
            }
        }
        

        private void button4_Click(object sender, EventArgs e)
        {
            //ADD with POST
            try
            {
                var httpWebRequest = (HttpWebRequest)WebRequest.Create(url);
                httpWebRequest.ContentType = "application/json";
                httpWebRequest.Method = "POST";

                using (var streamWriter = new StreamWriter(httpWebRequest.GetRequestStream()))
                {
                    string json = " {\r\n      \r\n        \"number\": \"" + textBox2.Text + "\",\r\n        \"expiryDate\": \"" + textBox3.Text + "\",\r\n        \"controlNumber\": " + textBox4.Text + ",\r\n        \"type\": \"" + comboBox1.Text + "\"\r\n    }";
                    streamWriter.Write(json);

                }


                var httpResponse = (HttpWebResponse)httpWebRequest.GetResponse();
                using (var streamReader = new StreamReader(httpResponse.GetResponseStream()))
                {
                    var result = streamReader.ReadToEnd();
                }

                Show_ALL();
            }
            catch
            {
                MessageBox.Show("Check if all fields is full");
            }
            
           
        }

        private void button3_Click(object sender, EventArgs e)
        {
            string message = "Are you sure !!";
            string title = "Deleting ";
            // Delete 
            try
            {

                
              
                    var httpWebRequest = (HttpWebRequest)WebRequest.Create(url + id_mod.Text);

                    httpWebRequest.Method = "DELETE";




                    var httpResponse = (HttpWebResponse)httpWebRequest.GetResponse();
                MessageBoxButtons buttons = MessageBoxButtons.YesNo;
                DialogResult r = MessageBox.Show(message, title, buttons);
                if (r == DialogResult.Yes)
                {
                    using (var streamReader = new StreamReader(httpResponse.GetResponseStream()))
                    {
                        var result = streamReader.ReadToEnd();
                    }
                    Show_ALL();
                    Emptyfield();
                }
                else
                    MessageBox.Show("Operation failed");
            }
            catch
            {
                MessageBox.Show("Double Click on The Column where the customer is located then click on the Delete button");
            }
            
           
        }

        private void dataGridView1_DoubleClick(object sender, EventArgs e)
        {
            
            id_mod.Text = dataGridView1.CurrentRow.Cells[0].Value.ToString();
            textBox2.Text = dataGridView1.CurrentRow.Cells[1].Value.ToString();
            textBox3.Text = dataGridView1.CurrentRow.Cells[2].Value.ToString();
            textBox4.Text = dataGridView1.CurrentRow.Cells[3].Value.ToString();
            comboBox1.Text = dataGridView1.CurrentRow.Cells[4].Value.ToString();
        }
        void Emptyfield()
        {
            id_mod.Text = "None";
            textBox2.Text = "";
            textBox3.Text = "";
            textBox4.Text = "";
            comboBox1.Text = "";
        }

        private void textBox4_KeyPress(object sender, KeyPressEventArgs e)
        {
                if (!char.IsControl(e.KeyChar) && !char.IsDigit(e.KeyChar) &&
                    (e.KeyChar != '.'))
                {
                    e.Handled = true;
                }

                // only allow one decimal point
                if ((e.KeyChar == '.') && ((sender as TextBox).Text.IndexOf('.') > -1))
                {
                    e.Handled = true;
                }
            
        }
    }
   
}

   }
 ```
 ## 1 - PHP CURL Web:

### a) Tools and Technologies Used
  * PHP 7 
  * HTML5 , CSS3
  * Bootstrap v4.4.1 
  * JQuery 2.2.4
  * PHP cURL

### b) Project Structure
Hints: 
 * files ending with "C" are the controllers.
 * card.png is the logo used in the project.
 * Header to import the libriaries and maintain the navbar design in all pages.

![Packaging Structure](https://i.ibb.co/jWVjM6g/Structure.jpg?raw=true)

### c) First Page

![Packaging Structure](https://i.ibb.co/9YGsfj7/index.jpg?raw=true)


### d) Index.php
``` PHP
<html>


<?php
include 'header.php';
$url = "http://localhost:8080/api/v1/creditcard"; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$cards = json_decode($data); // decode the JSON feed

?>


  <br>  
<h3 class="text-center" class="display-4">List of The cards</h3>
    <br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Number</th>
      <th scope="col">Expiry Date</th>
      <th scope="col">Control Number</th>
      <th scope="col">Type</th>
    </tr>
  </thead>
  <?php foreach ($cards as $card) : ?>
  <tbody>
  
    <tr>
        <td> <?php echo $card->id; ?> </td>
        <td> <?php echo $card->number; ?> </td>
        <td> <?php echo $card->expiryDate; ?> </td>
        <td> <?php echo $card->controlNumber; ?> </td>
        <td> <?php echo $card->type; ?> </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</html>
```

### d) Header and libraries

``` PHP
<!doctype html>
<html lang="en">
 <head>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.2/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.4.2/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.4.2/dist/js/uikit-icons.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>

    <!-- Icon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
</head>

    <title>Card Validator</title>
    
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    
    
    <h3 class="display-4 ">Card Validator</h3>
    <a class="navbar-brand" href="http://localhost/card/index.php">
    <img src="card.png" width="50" height="50" alt="">
    </a>
    
    
    <a class="nav-item nav-link " href="http://localhost/card/index.php">Home</a>

    <a class="nav-item nav-link " href="http://localhost/card/register.php">Register your card</a>

    <a class="nav-item nav-link " href="http://localhost/card/update.php">Update your card</a>

    <a class="nav-item nav-link " href="http://localhost/card/delete.php">Delete your card</a>

</nav>

  </head>
 </html>
```
