import java. util.Date;
import java.text.SimpleDateFormat;

public class Data {
    public static void main(String[] args) {
        Date data = new Date();
        String dzien = String.format("%TA", data);
        SimpleDateFormat dat = new SimpleDateFormat("dd-MM-YYYY");
        System.out.println(dzien + ", " + dat.format(data));
    }
}
