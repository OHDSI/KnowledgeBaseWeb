import java.sql.*;
import javax.xml.parsers.*;
import org.w3c.dom.*;
import java.net.URL;

public class RxNormTerms{

    public static final String SCHEMA_NAME = "clinical_cumc";
    //public static final String MYSQL_SERVER_NAME = "mimir.dbmi.columbia.edu";
    public static final String MYSQL_SERVER_NAME = "localhost";
    public static final int MYSQL_PORT = 3306;
    public static final String MYSQL_LOGIN_NAME = "root";
    public static final String MYSQL_PASSWORD = "kuancfit";
    public static final boolean USES_SSH_TUNNEL = true;
    static public final String DRIVER = "com.mysql.jdbc.Driver";

    public static void main(String argv[]){
	RxNormTerms rnt = new RxNormTerms();
	rnt.go();
    }

    public Connection getConnection(){
	Connection c = null;
	try{
	    Class.forName(DRIVER);
	    c = DriverManager.getConnection("jdbc:mysql://" + MYSQL_SERVER_NAME + ":" + MYSQL_PORT + "/" + SCHEMA_NAME);
	}catch(Exception e){
	    e.printStackTrace();
	    System.out.println("Couldn't get mysql driver or connect to database");
	    System.exit(0);
	}
	return c;
    }

    public void go(){

	String [] termTypes = 
	    {"BN","BPCK","DF","DFG","GPCK","IN","MIN","PIN","SBD","SBDC","SBDF","SBDG","SCD","SCDC","SCDF","SCDG"};
	
	DocumentBuilderFactory dbf = null;
	DocumentBuilder db = null;

	Connection conn = getConnection();

	try{
	    dbf = DocumentBuilderFactory.newInstance();
	    db = dbf.newDocumentBuilder();
	}catch(Exception e){
	    System.out.println("Could not form parser classes");
	    System.exit(0);
	}
	

	for(int i = 0 ; i < termTypes.length ; i++){
	    String termListURL = 
		"https://rxnav.nlm.nih.gov/REST/allconcepts?tty=" + termTypes[i];
	    try{
		Document doc = db.parse(new URL(termListURL).openStream());
		NodeList minConceptGroup = doc.getElementsByTagName("minConceptGroup");
		NodeList nl = doc.getElementsByTagName("minConcept");
		System.out.println("size : " + nl.getLength());
		for(int j = 0 ; j < nl.getLength() ; j++){
		    Node concept = nl.item(j);
		    NodeList children = concept.getChildNodes();
		    String rxcui = children.item(0).getTextContent();
		    String name = children.item(1).getTextContent();
		    
		}
	    }catch(Exception e){
		System.out.println("Could not parse URL: " + termListURL);
		e.printStackTrace();
	    }
	}
    }

}
