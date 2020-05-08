using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using Newtonsoft.Json.Linq;
using System.Net;
using System.IO;
using Newtonsoft.Json;

namespace WindowsFormsApp1
{
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
