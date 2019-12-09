using System;
using MySql.Data.MySqlClient;


namespace TeamFinderInstaller
{
    class Program
    {
        static void Main(string[] args)
        {

            string host = "127.0.0.1";
            string userName = "root";
            string password = "";
            string installType = "";
            do
            {
                Console.Write("Installation type (0 = default, 1 = custom): ");
                installType = Console.ReadLine();
                switch (installType)
                {
                    case "0":
                    case "1":
                        break;
                    default:
                        Console.WriteLine("Invalid input!");
                        installType = "";
                        break;
                }
            } while (installType.Equals(""));

            if (installType.Equals("1"))
            {
                Console.Write("Host name: ");
                host = Console.ReadLine();

                Console.Write("User name: ");
                userName = Console.ReadLine();

                Console.Write("Password: ");
                password = Console.ReadLine();
            }

            //@"server=192.168.28.48;userid=myusername;password=mypasswd";

            string cs = @"server=" + host + ";userid=" + userName + ";password=" + password;
            MySqlConnection conn = null;
            MySqlCommand cmd;

            Console.Clear();
            try
            {
                Console.WriteLine("Opening connection");
                conn = new MySqlConnection(cs);
                conn.Open();

                Console.WriteLine("Creating database");
                string sql = "CREATE DATABASE IF NOT EXISTS `teamfinder` CHARACTER SET UTF8 COLLATE utf8_hungarian_ci;";
                cmd = new MySqlCommand(sql, conn);
                cmd.ExecuteNonQuery();

                Console.WriteLine("Creating 'players' table");
                conn.Close();
                cs += ";database=teamfinder;";
                conn = new MySqlConnection(cs);
                conn.Open();
                sql = "CREATE TABLE IF NOT EXISTS `Players` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,`name` VARCHAR(255) NOT NULL,`birthDay` DATE NOT NULL,`email` VARCHAR(255) NOT NULL,`password` VARCHAR(255) NOT NULL); ";
                cmd = new MySqlCommand(sql, conn);
                cmd.ExecuteNonQuery();

                Console.WriteLine("Creating 'Advertisement' table");
                sql = "CREATE TABLE IF NOT EXISTS  `Advertisement` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,`game` VARCHAR(255) NOT NULL,`skillRange` VARCHAR(255),`lookingFor` VARCHAR(255),`age` VARCHAR(255),`region` VARCHAR(255),`role` VARCHAR(255),`goal` VARCHAR(255),`advertiserID` INT NOT NULL,`language` VARCHAR(255),`communication` VARCHAR(255),`teamName` VARCHAR(255))";
                cmd = new MySqlCommand(sql, conn);
                cmd.ExecuteNonQuery();

                Console.WriteLine("Creating 'messages' table");
                sql = "CREATE TABLE IF NOT EXISTS  `messages` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,`fromId` INT NOT NULL,`toID` INT NOT NULL,`text` VARCHAR(255) NOT NULL,`sendTime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
                cmd = new MySqlCommand(sql, conn);
                cmd.ExecuteNonQuery();

            }
            catch (MySqlException ex)
            {
                Console.WriteLine("Something went wrong :'(");
                Console.WriteLine(ex.Message);
            }
            finally
            {
                if (conn != null)
                {
                    Console.WriteLine("Closing connection");
                    conn.Close();
                }
            }

            Console.WriteLine("Installation finished! Press ENTER to exit!");
            Console.ReadLine();
        }
    }
}
