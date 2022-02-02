import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.ResultSet;

public class Baza {
    public static void main(String[] argv) throws Exception {
        String serverName = "localhost";
        String mydatabase = "zoo";
        String url = "jdbc:mysql://" + serverName + "/" + mydatabase; 
    
        String username = "root";
        String password = "";
        try{
          Connection conn = DriverManager.getConnection(url, username, password);
          Statement stmt = conn.createStatement();
          ResultSet rs = stmt.executeQuery("SELECT count(*) FROM zadania");
          while (rs.next()){
            System.out.print("LICZBA ZADAN DO WYKONANIA " + rs.getInt("count(*)"));
            
            
          }
          
        }
        catch(SQLException e){
          System.out.println("Błąd");
          e.printStackTrace();
        }
        
       
      }
}



 
