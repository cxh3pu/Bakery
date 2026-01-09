import java.sql.*;

public class User {
  private int id;
  private String username;
  private String password;

  public User(String username, String password) {
    this.username = username;
    this.password = password;
  }

  public int getId() {
    return id;
  }

  public String getUsername() {
    return username;
  }

  public boolean authenticate(String password) {
    return this.password.equals(password);
  }

  public static User login(String username, String password) throws SQLException {
    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/mydatabase", "username", "password");
    PreparedStatement stmt = conn.prepareStatement("SELECT * FROM users WHERE username = ?");
    stmt.setString(1, username);
    ResultSet rs = stmt.executeQuery();

    if (rs.next()) {
      User user = new User(rs.getString("username"), rs.getString("password"));
      if (user.authenticate(password)) {
        user.id = rs.getInt("id");
        return user;
      }
    }

    return null;
  }

  public void save() throws SQLException {
    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/mydatabase", "username", "password");
    PreparedStatement stmt = conn.prepareStatement("INSERT INTO users (username, password) VALUES (?, ?)", Statement.RETURN_GENERATED_KEYS);
    stmt.setString(1, username);
    stmt.setString(2, password);
    stmt.executeUpdate();

    ResultSet rs = stmt.getGeneratedKeys();
    if (rs.next()) {
      id = rs.getInt(1);
    }
  }

  public Profile getProfile() throws SQLException {
    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/mydatabase", "username", "password");
    PreparedStatement stmt = conn.prepareStatement("SELECT * FROM profiles WHERE user_id = ?");
    stmt.setInt(1, id);
    ResultSet rs = stmt.executeQuery();

    if (rs.next()) {
      return new Profile(rs.getString("name"), rs.getInt("age"), rs.getString("bio"));
    }

    return null;
  }

  public void updateProfile(Profile profile) throws SQLException {
    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/mydatabase", "username", "password");
    PreparedStatement stmt = conn.prepareStatement("UPDATE profiles SET name = ?, age = ?, bio = ? WHERE user_id = ?");
    stmt.setString(1, profile.getName());
    stmt.setInt(2, profile.getAge());
    stmt.setString(3, profile.getBio());
    stmt.setInt(4, id);
    stmt.executeUpdate();
  }
}

public class Profile {
  private String name;
  private int age;
  private String bio;

  public Profile(String name, int age, String bio) {
    this.name = name;
    this.age = age;
    this.bio = bio;
  }

  public String getName() {
    return name;
  }

  public int getAge() {
    return age;
  }

  public String getBio() {
    return bio;
  }
}
